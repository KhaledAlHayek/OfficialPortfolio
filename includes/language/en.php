<?php 
  function lang($word){
    static $words = [
      // header
      "Home" => "Home",
      "why iam special" => "why iam special",
      "Recent" => "Recent",
      "Experience" => "Experience",
      "Contact" => "Contact",
      "Education" => "Education",
      "Skills" => "Skills",
      "GALLERY1TITLE" => "Design & develop functional sites.",
      "GALLERY1BODY" => "In a professional and fast way that fits with the working methods of major specialized companies",
      "GALLERY2TITLE" => "Multilingual Websites.",
      "GALLERY2BODY" => "Build & develop a multilingual websites that offers content in more than one language.",
      "GALLERY3TITLE" => "Responsive Websites.",
      "GALLERY3BODY" => "Build web pages that detect the visitor's screen size and orientation and change the layout accordingly.",
      // intro
      "welcome & introduce" => "welcome & introduce",
      "NAME" => "hola! my name is khaled hayek!",
      "INTRO" => "I studied and graduated from the Lebanese International University with Bachelor's degree in Computer Science. I always like to learn new things in my field and to be more professional while doing my duty in my work or away from it in all the freelance work that I have done. I hope to start working to gain experience and prove myself.",
      "why choose me" => "why choose me?",
      "CHOOSEBODY1" => "Proficient in coding languages such as HTML, CSS, JavaScript, and jQuery. With understanding the principles of SEO, 
      having excellent skills in problem-solving, and understanding server-side development, I am a good choice for you to hire me!",
      "CHOOSEBODY2" => "Experienced with graphic design applications (e.g., Adobe Photoshop, Adobe Experience Design). Implemented and Developed
      websites starting from the design and ending with code. What you are viewing now has been designed before it was developed and coded.",
      "CHOOSEBODY3" => "Good communication with team members, superiors, clients and interpersonal skills. Adept at collaborating with my teammates because of my knowledge of version control systems like git & github.",
      // expertises
      "what i do" => "what i do",
      "expertise" => "here are some of my expertise",
      "EXPERTISE1TITLE" => "MOBILE-FIRST APPROACH",
      "EXPERTISE1BODY" => "Design and/or develop an experience for mobile before designing for desktop web or any other device. ",
      "EXPERTISE2TITLE" => "FIX BUGS AND ERRORS",
      "EXPERTISE2BODY" => "With my excellent problem solving, there is no way for bug in my development process. Bugs will be resolved as soon as they have been discovered.",
      "EXPERTISE3TITLE" => "CSS FRAMEWORKS AND PREPROCESSORS",
      "EXPERTISE3BODY" => "Avoiding repetitions and making my code more organized is a mandatory for me to save time and achieve my job before its expirtation time.",
      "EXPERTISE4TITLE" => "Adaptability",
      "EXPERTISE4BODY" => "To be successful, I constantly learn new approaches. Iam Always flexible, respond effectively to working conditions, and willing to go of outdated technology.",
      "EXPERTISE5TITLE" => "Time management",
      "EXPERTISE5BODY" => "Time management, organization, and the ability to prioritize tasks is of utmost importance to me to become a successful developer.",
      "EXPERTISE6TITLE" => "Teamwork",
      "EXPERTISE6BODY" => "It's essential for me to know how to support other people, ask for advice when needed, optimize the workflow, and deliver the end product quickly.",
      // recents
      "my work" => "my work",
      "recent work" => "recent work",
      "wrok 01" => "work 01",
      "WORK1BODY" => "eLearning website that contains with the main page, a dashboard for the admin and one for the instructors to manage thier content in the site.",
      "WORK2BODY" => "Online food ordering system contains a dashboard for the admin and one for the customers to view their orders.",
      "wrok 02" => "work 02",
      // experience
      "read" => "read",
      "Website" => "Website",
      "Details" => "Details",
      "read more" => "read more",
      "Finished" => "Finished",
      "Under Modifying" => "Under Modifying",
      // contact
      "Get in Touch" => "Get in Touch!",
      "CONTACTBODY" => "Available upon request. Please do not hesitate to contact me.",
      "CONTACTBUTTON" => "Contact Me",
      // rate
      "RATETITLE" => "Rate your overall experience.",
      "Rate now" => "Rate now",
      "Don't show again" => "Don't show again",
      "Name" => "Name",
      "Overall rating" => "Overall rating (0 - 10)",
      "Rate" => "Rate",
      // skills
      "SKILLSTITLE" => "Skills",
      "SKILLSBODY" => "Languages and tools",
      "MORETOOLSTITLE" => "you will find more tools and languages listed in my CV.",
      "DOWNLAODBTN" => "DOWNLOAD MY CV",
    ];

    return $words[$word];
  }
?>