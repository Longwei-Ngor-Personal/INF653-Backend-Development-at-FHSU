require("dotenv").config();
const express = require("express");
const mongoose = require("mongoose");
const path = require("path"); // Add this line to handle paths to the views
const app = express();

const authRoutes = require("./routes/authRoutes");
const eventRoutes = require("./routes/eventRoutes");
const bookingRoutes = require("./routes/bookingRoutes");

// Middleware to parse JSON body
app.use(express.json());

// Routes for API endpoints
app.use("/api/auth", authRoutes);
app.use("/api/events", eventRoutes);
app.use("/api/bookings", bookingRoutes);

// Simple landing page 
app.get("/", (req, res) => {
  res.json({
    message: "🎫 Event Ticketing API",
    version: "1.0.0",
    endpoints: {
      auth: "/api/auth",
      events: "/api/events",
      bookings: "/api/bookings"
    }
  });
});

// Keep this middleware
app.use((req, res) => {
  const acceptHeader = req.get('Accept') || '';
  
  if (acceptHeader.includes('text/html')) {
    // Return HTML 404 page
    res.status(404).send(`
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <title>404 - Not Found</title>
        <style>body{text-align:center;padding:50px;}</style>
      </head>
      <body>
        <h1>404</h1>
        <h2>Page Not Found</h2>
      </body>
      </html>
    `);
  } else {
    res.status(404).json({ error: "404 Not Found" });
  }
});

// Connect DB and start server
mongoose
  .connect(process.env.DATABASE_URI, {
    useNewUrlParser: true,
    useUnifiedTopology: true
  })
  .then(() => {
    app.listen(process.env.PORT || 5000, () => {
      console.log("Server running on http://localhost:5000");
    });
  })
  .catch((err) => {
    console.error("DB connection failed:", err.message);
  });
