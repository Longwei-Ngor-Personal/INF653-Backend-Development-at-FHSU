const mongoose = require("mongoose");
 
const connectDB = async () => {
  try {
    await mongoose.connect(process.env.DATABASE_URI, {
      useNewUrlParser: true,
      useUnifiedTopology: true
    });
    console.log("Connected to MongoDB");
  } catch (err) {
    console.error("Connection error:", err);
  }
};
 
module.exports = connectDB;