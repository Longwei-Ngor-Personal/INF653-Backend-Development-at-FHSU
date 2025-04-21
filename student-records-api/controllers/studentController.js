const Student = require("../models/studentModel");

// Create a new student
const createStudent = async (req, res) => {
    try {
      const result = await Student.create({
        studentId: req.body.studentId,  // Custom ID
        firstName: req.body.firstName,
        lastName: req.body.lastName,
        email: req.body.email,
        course: req.body.course,
        enrolledDate: req.body.enrolledDate,
      });
      res.status(201).json(result);
    } catch (err) {
      res.status(500).json({ error: err.message });
    }
  };  

// Get all students
const getAllStudents = async (req, res) => {
  try {
    const students = await Student.find();
    res.json(students);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

// Get a student by ID
const getStudentById = async (req, res) => {
    try {
      const student = await Student.findOne({ studentId: req.params.studentId }); // Use studentId
      if (!student) return res.status(404).json({ error: "Student not found" });
      res.json(student);
    } catch (err) {
      res.status(500).json({ error: err.message });
    }
  };  

// Update a student
const updateStudent = async (req, res) => {
    try {
      const student = await Student.findOne({ studentId: req.body.studentId }); // Use studentId here
      if (!student) return res.status(404).json({ error: "Student not found" });
  
      student.firstName = req.body.firstName;
      student.lastName = req.body.lastName;
      student.email = req.body.email;
      student.course = req.body.course;
      student.enrolledDate = req.body.enrolledDate;
  
      const result = await student.save();
      res.json(result);
    } catch (err) {
      res.status(500).json({ error: err.message });
    }
  };
// Delete a student
const deleteStudent = async (req, res) => {
    try {
      const result = await Student.deleteOne({ studentId: req.body.studentId });  // Use studentId here
      res.json(result);
    } catch (err) {
      res.status(500).json({ error: err.message });
    }
  };
  

module.exports = {
  createStudent,
  getAllStudents,
  getStudentById,
  updateStudent,
  deleteStudent,
};
