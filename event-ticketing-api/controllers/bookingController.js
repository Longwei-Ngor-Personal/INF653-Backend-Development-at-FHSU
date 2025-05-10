const Booking = require("../models/booking");
const Event = require("../models/Event");
const generateQRCode = require("../utils/generateQRcode");
const sendEmail = require("../utils/sendemail");

const getUserBookings = async (req, res) => {
  try {
    const bookings = await Booking.find({ user: req.user.id }).populate("event");
    res.json({
      success: true,
      count: bookings.length,
      data: bookings
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

const getBookingById = async (req, res) => {
  try {
    const booking = await Booking.findById(req.params.id).populate("event");
    if (!booking) {
      return res.status(404).json({
        success: false,
        error: "Booking not found"
      });
    }
    
    if (booking.user.toString() !== req.user.id) {
      return res.status(403).json({
        success: false,
        error: "Unauthorized access"
      });
    }
    
    res.json({
      success: true,
      data: booking
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

const createBooking = async (req, res) => {
  try {
    const { event: eventId, quantity } = req.body;
    
    const event = await Event.findById(eventId);
    if (!event) {
      return res.status(404).json({
        success: false,
        error: "Event not found"
      });
    }
    
    if (event.bookedSeats + quantity > event.seatCapacity) {
      return res.status(400).json({
        success: false,
        error: "Not enough seats available"
      });
    }
    
    event.bookedSeats += quantity;
    await event.save();
    
    // Generate the raw QR code value
    const qrCodeValue = eventId + "-" + Date.now();
    // Generate the QR code image data
    const qrCode = await generateQRCode(qrCodeValue);
    
    const booking = await Booking.create({
      user: req.user.id,
      event: eventId,
      quantity,
      bookingDate: new Date(),
      qrCode,
      qrCodeValue: qrCodeValue,
    });
    
    // 🎉 Email Confirmation
    try {
      await sendEmail(
        req.user.email,
        "Booking Confirmation",
        `<h2>Your booking for ${event.title} is confirmed!</h2>
         <p><strong>Booking ID:</strong> ${booking._id}</p>
         <p><strong>Quantity:</strong> ${quantity}</p>
         <p><strong>Event Date:</strong> ${new Date(event.date).toLocaleString()}</p>
         <img src="${qrCode}" alt="QR Code" style="width:200px; height:auto;"/>`
      );
    } catch (emailErr) {
      console.error("Email sending failed:", emailErr.message);
      // Continue with booking creation even if email fails
    }
    
    res.status(201).json({
      success: true,
      data: booking
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

const validateQR = async (req, res) => {
  try {
    const qr = req.params.qr;
    const booking = await Booking.findOne({ qrCodeValue: qr }).populate("event");
    
    if (!booking) {
      return res.status(404).json({
        success: false,
        error: "Invalid QR code"
      });
    }
    
    res.json({
      success: true,
      data: {
        valid: true,
        booking
      }
    });
  } catch (err) {
    res.status(500).json({
      success: false,
      error: err.message
    });
  }
};

module.exports = {
  getUserBookings,
  getBookingById,
  createBooking,
  validateQR,
};