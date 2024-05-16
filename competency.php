<?php
// Include the session.php file to enforce session-based authentication
include('session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C PROGRAMMING</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="rs.css">
</head>

<body>
    <div id="menu-btn" class="fas fa-bars"></div>
    <header class="header">
        <a href="#" class="logo"><i class="fas fa-graduation-cap"></i>C Learning App</a>
        <nav class="navbar">
            <a href="#home"><i class="fas fa-angle-right"></i>Home</a>
            <a href="#category"><i class="fas fa-angle-right"></i>Category</a>
            <a href="#about"><i class="fas fa-angle-right"></i>About</a>
            <a href="#courses"><i class="fas fa-angle-right"></i>Levels</a>
            <a href="#pricing"><i class="fas fa-angle-right"></i>Future For C Programming</a>
            <a href="login.html"><i class="fas fa-angle-right"></i>Logout</a>
        </nav>
    </header>
    <section class="home" id="home">
        <div class="image">
            <img src="home-img.svg" alt="">
        </div>
        <div class="content">
            <h3>A better learning future starts here. <a href="#">get started</a></h3>
            <p>Welcome to our C Programming Learning App! Unlock the power of coding with us. Let's embark on a journey
                to master the fundamentals and unleash your programming potential. Happy coding!</p>
            <a href="#courses" class="btn">our courses</a>
        </div>
    </section>
    <section class="category" id="category">
        <div class="heading">
            <span>Our Category</span>
            <h3>Our Top Category</h3>
        </div>
        <div class="box-container">
            <div class="box">
                <i class="fas fa-code"></i>
                <h3>C Programming</h3>
                <p>We offers c programming concepts from Basic to Advance.</p>
            </div>
        </div>
    </section>
    <section class="about" id="about">
        <div class="image">
            <img src="about-img.svg" alt="">
        </div>

        <div class="content">
            <span>About us</span>
            <h3>Best online platform for C-learning.</h3>
            <p>These platforms offer courses, tutorials, and interactive exercises to help you learn C programming at
                your own pace. <br> They also provide interactive tutorials that allow you to practice coding concepts
                in a hands-on manner.
            </p>
            <a href="#" class="btn">read more</a>
        </div>
    </section>
    <section class="courses" id="courses">
        <div class="heading">
            <h3>Select Your Level</h3>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="22.png" alt="">
                    <h3>Beginner</h3>
                </div>
                <div class="content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Beginner</h3>
                    <a href="topic.php" class="btn">Start</a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="55.png" alt="">
                    <h3>Intermediate</h3>
                </div>
                <div class="content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Intermediate</h3>
                    <a href="topicinter.php" class="btn">Start</a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="33.png" alt="">
                    <h3>Advanced</h3>
                </div>
                <div class="content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Advanced</h3>
                    <a href="topicexpert.php" class="btn">Start</a>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing" id="pricing">
        <div class="box">
            <h1 style="color: aqua;">What is the future of C-Programing?</h1>
            <p>The future of e-learning holds exciting prospects, transforming education in unprecedented ways. As
                technology continues to advance, the landscape of online learning is poised to evolve, offering learners
                and educators innovative opportunities for engagement and collaboration.

                One key aspect of the future of e-learning is personalized learning experiences. With the integration of
                artificial intelligence (AI) and machine learning algorithms, educational platforms can tailor content
                to individual learner needs. This adaptability ensures that each student progresses at their own pace,
                focusing on areas where they need more support and accelerating through familiar concepts. Personalized
                learning not only enhances comprehension but also fosters a more inclusive educational environment that
                accommodates diverse learning styles.

                Virtual reality (VR) and augmented reality (AR) are set to play a significant role in the future of
                e-learning. These immersive technologies enable students to step into virtual classrooms, conduct
                experiments in simulated laboratories, and explore historical events as if they were present. Such
                experiential learning can greatly enhance understanding and retention, making complex subjects more
                accessible and engaging. Additionally, VR and AR facilitate collaborative learning, allowing students to
                interact with peers and instructors in virtual spaces.

                The rise of microlearning is another trend shaping the future of e-learning. Microlearning involves
                delivering content in bite-sized, easily digestible modules. This approach accommodates the modern
                learner's preference for shorter, focused learning sessions, promoting better retention and
                understanding. Mobile devices play a crucial role in microlearning, providing learners the flexibility
                to access educational content anytime, anywhere.

                Blockchain technology is poised to address concerns related to credentialing and certification in
                e-learning. By using blockchain, educational institutions can create secure, verifiable records of
                academic achievements, reducing fraud and ensuring the validity of qualifications. This not only
                benefits learners but also enhances the credibility of online education.

                Collaborative and social learning will continue to be emphasized in the future of e-learning. Online
                platforms will increasingly integrate features that facilitate group projects, discussions, and
                peer-to-peer interactions. This collaborative approach mirrors real-world work environments, preparing
                students for effective teamwork and communication skills.

                The future also holds promise for the integration of data analytics in e-learning. Analyzing user data
                can provide valuable insights into learning patterns, allowing educators to refine and customize content
                further. This data-driven approach enables continuous improvement in the effectiveness of online
                educational programs.

                In conclusion, the future of e-learning is a dynamic landscape shaped by emerging technologies and a
                commitment to enhancing the learning experience. From personalized learning powered by AI to immersive
                VR experiences and the rise of microlearning, these trends are collectively redefining how education is
                delivered and experienced in the digital age. As educators and learners embrace these advancements, the
                potential for accessible, engaging, and effective online education will continue to expand.
                <br><br>
                <img src="a.jpg" alt="" width="100%"><br><br>
            <p>
        </div>
    </section>
</body>

</html>