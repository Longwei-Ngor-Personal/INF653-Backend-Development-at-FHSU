const express = require("express");
const dotenv = require("dotenv");
const connectDB = require("./dbConfig");
const studentRoutes = require("./routes/studentRoutes");

dotenv.config(); // Load environment variables
const app = express();

// Middleware to parse JSON
app.use(express.json());

// Connect to MongoDB
connectDB();

// Use student routes
app.use("/students", studentRoutes);

// Start the server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
