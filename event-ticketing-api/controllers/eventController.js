const Event = require("../models/event");

const getAllEvents = async (req, res) => {
  try {
    const query = {};
    if (req.query.category) query.category = req.query.category;
    if (req.query.date) query.date = new Date(req.query.date);
      
    const events = await Event.find(query);
    res.json({
      success: true,
      count: events.length,
      data: events
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

const getEventById = async (req, res) => {
  try {
    const event = await Event.findById(req.params.id);
    if (!event) {
      return res.status(404).json({
        success: false,
        error: "Event not found"
      });
    }
    
    res.json({
      success: true,
      data: event
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

const createEvent = async (req, res) => {
  try {
    const event = await Event.create(req.body);
    res.status(201).json({
      success: true,
      data: event
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

const updateEvent = async (req, res) => {
  try {
    const event = await Event.findById(req.params.id);
    if (!event) {
      return res.status(404).json({
        success: false,
        error: "Event not found"
      });
    }
    
    if (req.body.seatCapacity < event.bookedSeats) {
      return res.status(400).json({
        success: false,
        error: "seatCapacity can't be below bookedSeats"
      });
    }
    
    Object.assign(event, req.body);
    await event.save();
    
    res.json({
      success: true,
      data: event
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

const deleteEvent = async (req, res) => {
  try {
    const event = await Event.findById(req.params.id);
    if (!event) {
      return res.status(404).json({
        success: false,
        error: "Event not found"
      });
    }
    
    await event.deleteOne();
    
    res.json({
      success: true,
      data: {}
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

module.exports = {
  getAllEvents,
  getEventById,
  createEvent,
  updateEvent,
  deleteEvent,
};