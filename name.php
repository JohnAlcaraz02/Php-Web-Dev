<?php
$name = "JOHN C. ALCARAZ";
$contact = [
    "address" => "Matingain 1, Lemery Batangas",
    "phone" => "09156946204",
    "email" => "johnalcaraz026@gmail.com"
];

$objective = "Aspiring CS professional with a focus on web technologies, data processing, and AI automation. Driving to transform ideas into innovative solutions by leveraging both technical skills and creativity. Excited to explore opportunities that foster growth and contribute to technological advancement in a globalized world.";

$skills = [
    "Programming Languages" => "Python, Java, JavaScript, C++",
    "Web Development" => "HTML, CSS, Swift, Flutter",
    "Databases" => "MySQL",
    "AI & Automation" => "Chatbot development, Task automation, Workflow optimization, Data processing automation",
    "Tools" => "Git/GitHub, IntelliJ, VS Code, Figma"
];

$education = [
    "university" => "Batangas State University",
    "degree" => "Bachelor of Science in Computer Science",
    "graduation" => "Expected Graduation: 2027"
];

$projects = [
    "GoalGetter App (Personal Project)" => "Developed a productivity app with PIN authentication and task reminder notifications. Implemented AI-powered task suggestions and automation for reminders.",
    "Crop Monitoring Website (School Project)" => "Built a simple website using HTML, CSS, and JavaScript. Assisted in gathering and organizing agricultural data for presentation.",
    "AI Task Automation Scripts" => "Created Python scripts to automate repetitive tasks such as file management and report generation. Applied natural language processing to handle simple chatbot queries."
];

$workshops = [
    "Attended webinars on AI automation, data privacy, and IT career paths.",
    "Completed online courses in Machine Learning & Automation Tools.",
    "Participated in coding challenges focused on AI applications."
];

$organizations = [
    "Junior Philippine Computer Society (JPCS) – Member",
    "Association of Committed Computer Science Students (ACCESS) – 3rd Year Representative"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?> - CV</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Profile photo -->
        <img src="bf010f7d-4a7b-4265-8bd4-cb458e2b845d.jpg" alt="Profile Picture" class="profile-pic">

        <h1><?= $name ?></h1>
        <p class="contact">
            <?= $contact["address"] ?> | <?= $contact["phone"] ?> | 
            <a href="mailto:<?= $contact["email"] ?>"><?= $contact["email"] ?></a>
        </p>

        <div class="section">
            <h2>Objective</h2>
            <p><?= $objective ?></p>
        </div>

        <div class="section">
            <h2>Technical Skills</h2>
            <ul>
                <?php foreach ($skills as $category => $skillset): ?>
                    <li><strong><?= $category ?>:</strong> <?= $skillset ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="section">
            <h2>Education</h2>
            <p><strong><?= $education["university"] ?></strong><br>
            <?= $education["degree"] ?><br>
            <?= $education["graduation"] ?></p>
        </div>

        <div class="section">
            <h2>Projects & Practical Experience</h2>
            <ul>
                <?php foreach ($projects as $title => $desc): ?>
                    <li><strong><?= $title ?>:</strong> <?= $desc ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="section">
            <h2>Workshops & Online Learning</h2>
            <ul>
                <?php foreach ($workshops as $w): ?>
                    <li><?= $w ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="section">
            <h2>Organizations</h2>
            <ul>
                <?php foreach ($organizations as $org): ?>
                    <li><?= $org ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <button class="print-btn" onclick="window.print()">🖨️ Print Resume</button>
    </div>
</body>
</html>
