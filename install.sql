-- Create tables
CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id VARCHAR(50) UNIQUE NOT NULL,
  student_name VARCHAR(100) NOT NULL,
  assigned_club VARCHAR(100) DEFAULT NULL,
  assigned_tutoring VARCHAR(100) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS clubs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  club_name VARCHAR(100) NOT NULL,
  category VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS attendance (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id VARCHAR(50) NOT NULL,
  session_date DATE NOT NULL,
  type ENUM('club', 'tutoring') NOT NULL,
  checkin_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS teachers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL
);

-- Insert clubs
INSERT INTO clubs (club_name, category) VALUES
('DECA (National CTSO)', 'Business / Marketing'),
('FBLA (National CTSO)', 'Business / Marketing'),
('FCCLA (National CTSO)', 'Family and Consumer Sciences'),
('Fellowship of Christian Athletes and Students', 'Personal Development'),
('FFA (National CTSO)', 'Agriculture'),
('Key Club (National Organization)', 'Community Service / Leadership'),
('NHS (National Organization)', 'Academic / Leadership'),
('NTHS (National CTSO)', 'Technical Education'),
('Skills USA (National CTSO)', 'Technical / Vocational'),
('Student Council', 'Leadership / Governance'),
('International Thespian Society', 'Performing Arts'),
('Beta Club', 'Academic Achievement / Leadership / Service'),
('Math Club', 'Mathematics'),
('Math 1 & 3 EOC Prep', 'Mathematics'),
('Biology EOC Prep', 'Science'),
('STEAM', 'Science / Technology / Arts / Math'),
('Student Equity', 'Social Studies / Inclusivity'),
('Speech and Debate Club', 'Language Arts / Public Speaking'),
('DEAR (Drop Everything And Read)', 'Literacy / Language Arts'),
('English 2 EOC Prep', 'Language Arts'),
('Knit Wit Lit Club', 'Arts / Literacy'),
('AI Club', 'Computer Science / Technology'),
('Career | Internship 101 | Job Readiness', 'Career Development'),
('Undergrad Prep', 'Academic / College Readiness'),
('Graphic Design Club', 'Arts / Technology'),
('Color Guard', 'Performing Arts'),
('Dance Council', 'Performing Arts'),
('Step Club', 'Performing Arts / Physical Education'),
('Health and Wellness Club', 'Physical Fitness / Mental Health'),
('Intramural Sports', 'Physical Education'),
('Yoga & Meditation Club', 'Wellness / Stress Relief'),
('PEPI "Breakfast" Club', 'Physical Fitness / Wellness'),
('Spanish Club', 'Hispanic Culture / Language'),
('French Club', 'French Culture / Language'),
('Mandarin Club', 'Chinese Culture / Language'),
('JROTC Leadership & Academic Bowl', 'Leadership / Academics'),
('JROTC Drill Team', 'Physical Education / Teamwork'),
('JROTC Community Service', 'Leadership / Civic Engagement'),
('V.I.D.A (Hispanic Heritage)', 'Celebrating Hispanic Culture and Heritage'),
('Asian Heritage Club', 'Celebrating Asian Culture and Heritage'),
('SAAB (Student African American Brotherhood)', 'African American Cultural Awareness'),
('SAAS (Student African American Sisterhood)', 'Empowering African American Students');

-- Insert default admin user
-- Password is hashed version of "adminpass"
INSERT INTO teachers (username, password_hash) VALUES
('admin', '$2y$10$O/lDp1tVjJmp4a0xJ7kP3u1G1pMDEkOl0LtVb9DK4iD39dfAphR0e'); -- password: adminpass
