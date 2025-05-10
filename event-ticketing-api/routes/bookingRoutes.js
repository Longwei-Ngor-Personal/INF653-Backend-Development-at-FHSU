const express = require("express");
const router = express.Router();
const {
  getUserBookings,
  getBookingById,
  createBooking,
  validateQR,
} = require("../controllers/bookingController");
const { protect } = require("../middleware/authMiddleware");

router.get("/", protect, getUserBookings);
// Bonus route (optional)
router.get("/validate/:qr", validateQR);
router.get("/:id", protect, getBookingById);
router.post("/", protect, createBooking);

module.exports = router;
