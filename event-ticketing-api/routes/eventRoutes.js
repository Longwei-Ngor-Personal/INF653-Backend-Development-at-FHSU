const express = require("express");
const router = express.Router();
const {
  getAllEvents,
  getEventById,
  createEvent,
  updateEvent,
  deleteEvent,
} = require("../controllers/eventController");
const { protect, adminOnly } = require("../middleware/authMiddleware");

// Public Routes
router.get("/", getAllEvents); // supports ?category=&date=
router.get("/:id", getEventById);

// Admin Routes
router.post("/", protect, adminOnly, createEvent);
router.put("/:id", protect, adminOnly, updateEvent);
router.delete("/:id", protect, adminOnly, deleteEvent);

module.exports = router;
