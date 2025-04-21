const express = require("express");
const router = express.Router();
const {
  createStudent,
  getAllStudents,
  getStudentById,
  updateStudent,
  deleteStudent,
} = require("../controllers/studentController");

// Base route: /students

// GET all students
router.get("/", getAllStudents);

// GET one student by ID
router.get("/:studentId", getStudentById);

// POST a new student
router.post("/", createStudent);

// PUT to update a student
router.put("/", updateStudent);

// DELETE a student
router.delete("/", deleteStudent);

module.exports = router;
