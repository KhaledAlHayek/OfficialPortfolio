<?php 
  session_start();
  ob_start();
  $page_title = "Khaled Ali Hayek - Portfolio Website";
  include_once "init.php";
  include_once $template . "header.php";
  ?>
  <header>
    <div class="header header-content-above">
      <div class="menu">
        <div class="logo">
          <h1>KH</h1>
        </div>
        <div class="menu-items">
          <div class="collapse-menu">
            <i class="fas fa-times"></i>
          </div>
          <ul>
            <li><a href="#" class="active" data-target="introduce"><?php echo lang("Home"); ?></a></li>
            <li><a href="#" data-target="why-iam-special"><?php echo lang("why iam special"); ?></a></li>
            <li><a href="#" data-target="recent-work"><?php echo lang("Recent"); ?></a></li>
            <li><a href="#" data-target="my-experience"><?php echo lang("Experience"); ?></a></li>
            <li><a href="#" data-target="contact-me"><?php echo lang("Contact"); ?></a></li>
            <li><a href="#" data-target="skills"><?php echo lang("Skills"); ?></a></li>
          </ul>
        </div>
        <div class="bars">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="header-content">
        <div class="arrow previous">
          <i class="fas fa-chevron-left"></i>
        </div>
        <div class="arrow next">
          <i class="fas fa-chevron-right"></i>
        </div>
        <div class="gallery-slider">
          <img src="./layout/images/FrontEnd.jpg" alt="Frontend Development">
          <div class="box">
            <div class="img-box">
              <h2><?php echo lang("GALLERY1TITLE") ?></h2>
              <span><?php echo lang("GALLERY1BODY") ?></span>
            </div>
          </div>
        </div>
        <div class="gallery-slider">
          <img src="./layout/images/multilingual.jpg" alt="Multilingual Websites">
          <div class="box">
            <div class="img-box">
              <h2><?php echo lang("GALLERY2TITLE") ?></h2>
              <span><?php echo lang("GALLERY2BODY") ?></span>
            </div>
          </div>
        </div>
        <div class="gallery-slider">
          <img src="./layout/images/Responsive.jpg" alt="Responsice Wesbites">
          <div class="box">
            <div class="img-box">
              <h2><?php echo lang("GALLERY3TITLE") ?></h2>
              <span><?php echo lang("GALLERY3BODY") ?></span>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Welcome & Introduce -->
  <section id="introduce">
    <div class="intro">
      <div class="intro-img">
        <div class="img-over">
          <img src="./layout/images/Coder.jpg" alt="Coder Image">
        </div>
      </div>
      <div class="intro-text">
        <div class="intro-box">
          <span><?php echo lang("welcome & introduce") ?></span>
          <h2><?php echo lang("NAME") ?></h2>
          <p><?php echo lang("INTRO") ?></p>
        </div>
        <div class="why-choose-me">
          <div class="choose-box">
            <div class="choose-head">
              <h3><?php echo lang("why choose me") ?></h3>
              <i class="fas fa-arrow-down"></i>
            </div>
            <div class="choose-body">
              <p>
                <?php echo lang("CHOOSEBODY1") ?>
              </p>
            </div>
          </div>
          <div class="choose-box">
            <div class="choose-head">
              <h3><?php echo lang("why choose me") ?></h3>
              <i class="fas fa-arrow-down"></i>
            </div>
            <div class="choose-body">
              <p>
                <?php echo lang("CHOOSEBODY2") ?>
              </p>
            </div>
          </div>
          <div class="choose-box">
            <div class="choose-head">
              <h3><?php echo lang("why choose me") ?></h3>
              <i class="fas fa-arrow-down"></i>
            </div>
            <div class="choose-body">
              <p>
                <?php echo lang("CHOOSEBODY3") ?> 
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Skills -->
  <section id="why-iam-special">
    <div class="specials">
      <div class="section-title">
        <span><?php echo lang("what i do") ?></span>
        <h2><?php echo lang("expertise") ?></h2>
      </div>
      <div class="expertises">
        <div class="expertise">
          <div class="expertise-box">
            <div class="icon-box">
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
            </div>
            <div class="text-box">
              <span><?php echo lang("EXPERTISE1TITLE") ?></span>
              <p>
                <?php echo lang("EXPERTISE1BODY") ?>
              </p>
            </div>
          </div>
          <div class="expertise-box">
            <div class="icon-box">
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
            </div>
            <div class="text-box">
              <span><?php echo lang("EXPERTISE2TITLE") ?></span>
              <p>
                <?php echo lang("EXPERTISE2BODY") ?>
              </p>
            </div>
          </div>
          <div class="expertise-box">
            <div class="icon-box">
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
            </div>
            <div class="text-box">
              <span><?php echo lang("EXPERTISE3TITLE") ?></span>
              <p>
                <?php echo lang("EXPERTISE3BODY") ?>
              </p>
            </div>
          </div>
        </div>
        <div class="expertise">
          <div class="expertise-box">
            <div class="icon-box">
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
            </div>
            <div class="text-box">
              <span><?php echo lang("EXPERTISE4TITLE") ?></span>
              <p>
                <?php echo lang("EXPERTISE4BODY") ?>
              </p>
            </div>
          </div>
          <div class="expertise-box">
            <div class="icon-box">
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
            </div>
            <div class="text-box">
              <span><?php echo lang("EXPERTISE5TITLE") ?></span>
              <p>
                <?php echo lang("EXPERTISE5BODY") ?>
              </p>
            </div>
          </div>
          <div class="expertise-box">
            <div class="icon-box">
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
            </div>
            <div class="text-box">
              <span><?php echo lang("EXPERTISE6TITLE") ?></span>
              <p>
                <?php echo lang("EXPERTISE6BODY") ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- My Work -->
  <section id="recent-work">
    <div class="my-work">
      <div class="section-title">
        <span><?php echo lang("my work") ?></span>
        <h2><?php echo lang("recent work") ?></h2>
      </div>
      <div class="work-section">
        <div class="recent-box left-side">
          <div class="recent">
            <img src="./layout/images/eLearning.jpg" alt="Senior Project">
            <div class="overlay">
              <div class="recent-title">
                <h2><?php echo lang("wrok 01") ?></h2>
                <p><?php echo lang("WORK1BODY") ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="recent-box right-side">
          <div class="recent">
            <img src="./layout/images/food.jpg" alt="Online food Website">
            <div class="overlay">
              <div class="recent-title">
                <h2><?php echo lang("wrok 02") ?></h2>
                <p><?php echo lang("WORK2BODY") ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Experience -->
  <section id="my-experience">
    <div class="experience">
      <div class="section-title">
        <span><?php echo lang("read") ?></span>
        <h2><?php echo lang("Experience") ?></h2>
      </div>
      <div class="experience-list">
        <?php 
          $stmt = $connect->prepare("SELECT * FROM experience ORDER BY ID ASC");
          $stmt->execute();
          $experiences = $stmt->fetchAll();
          foreach($experiences as $experience):
            $stmt = $connect->prepare("SELECT COUNT(ID) FROM projectdetails WHERE exp_id = ?");
            $stmt->execute([$experience["ID"]]);
            $total_details = $stmt->fetchColumn();  
            $stmt1 = $connect->prepare("SELECT Details FROM projectdetails WHERE exp_id = ?");
            $stmt1->execute(array($experience["ID"]));
            $details = $stmt1->fetchColumn();
            $details = substr($details, 0, strlen($details) - 1);
            $array_of_details = explode("%", $details);
            ?>
              <div class="experience-box">
                <div class="view-details">
                  <div class="view-details-box">
                    <div class="close-details" data-closebox="close-box">
                      <i class="fas fa-times" data-closebox="close-box"></i>
                    </div>
                    <div class="title">
                      <h2>Other Details</h2>
                    </div>
                    <div class="details">
                      <ul>
                        <?php
                          foreach($array_of_details as $detail):
                            ?>
                              <li><span><?php echo $detail ?></span></li>
                            <?php
                          endforeach;
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="img-box">
                  <img src="./layout/images/Responsive.jpg" alt="">
                </div>
                <div class="info-box">
                  <div class="exp-info">
                    <ul>
                      <li>
                        <?php 
                          if($experience["Projectstatus"] == 1):
                            echo lang("Finished");
                          else:
                            echo lang("Under Modifying");
                          endif;
                        ?>
                      </li>
                      <li>|</li>
                      <li><?php echo lang("Website") ?></li>
                      <li>|</li>
                      <li><?php echo count($array_of_details) . " - " . lang("Details") ?></li>
                    </ul>
                  </div>
                  <div class="exp-title">
                    <h2><?php echo $experience["ProjectName"] ?></h2>
                  </div>
                  <div class="exp-details">
                    <p><?php echo $array_of_details[0] ?></p>
                  </div>
                  <div class="read-details">
                    <div class="more" data-showbox="view-more">
                      <span data-showbox="view-more"><?php echo lang("read more") ?></span>
                      <i class="fas fa-arrow-right" data-showbox="view-more"></i>
                    </div>
                  </div>
                </div>
              </div>
            <?php
          endforeach;
        ?>
      </div>
    </div>
  </section>
  <!-- Skills -->
  <section id="skills">
    <div class="my-skills">
      <div class="section-title">
        <span><?php echo lang("SKILLSTITLE") ?></span>
        <h2><?php echo lang("SKILLSBODY") ?></h2>
      </div>
      <div class="tools">
        <div class="tool">
          <img src="./layout/images/skills/html-5.png" alt="HTML">
          <h2>HTML</h2>
        </div>
        <div class="tool">
          <img src="./layout/images/skills/css-3.png" alt="CSS">
          <h2>CSS</h2>
        </div>
        <div class="tool">
          <img src="./layout/images/skills/sass.png" alt="SASS">
          <h2>SASS</h2>
        </div>
        <div class="tool">
          <img src="./layout/images/skills/js.png" alt="Javascript">
          <h2>Javascript</h2>
        </div>
        <div class="tool">
          <img src="./layout/images/skills/php.png" alt="PHP">
          <h2>PHP</h2>
        </div>
        <div class="tool">
          <img src="./layout/images/skills/react.png" alt="React Js">
          <h2>React Js</h2>
        </div>
        <div class="tool">
          <img src="./layout/images/skills/ajax.png" alt="AJAX">
          <h2>AJAX</h2>
        </div>
        <div class="tool">
          <img src="./layout/images/skills/photoshop.png" alt="Photoshop">
          <h2>Photoshop</h2>
        </div>
      </div>
      <div class="more-on-cv">
        <span><strong>*</strong> <?php echo lang("MORETOOLSTITLE") ?></span>
        <a href="/Portfolio/layout/CV/Khaled_ALi_Hayek_CV.pdf" download="Khaled_ALi_Hayek_CV.pdf">
          <i class="fas fa-download"></i>
          <span><?php echo lang("DOWNLAODBTN") ?></span>
        </a>
      </div>
    </div>
  </section>
  <!-- Contact Me -->
  <footer id="contact-me">
    <div class="contact-me">
      <div class="contact">
        <div class="get-in-touch">
          <h2><?php echo lang("Get in Touch") ?></h2>
        </div>
        <div class="info">
          <span>
            <i class="fas fa-envelope"></i>
            <p>khaledhyk.123@gmail.com</p>
          </span>
          <span>
            <i class="fas fa-phone"></i>
            <p>+961 70213460</p>
          </span>
        </div>
        <div class="msg">
          <p><?php echo lang("CONTACTBODY") ?></p>
        </div>
        <div class="contact-btn">
          <a href="mailto:khaledhyk.123@gmail.com"><?php echo lang("CONTACTBUTTON") ?></a>
        </div>
      </div>
    </div>
  </footer>
  <div class="scroll-top">
    <div class="scroll-icon">
      <i class="fas fa-chevron-up"></i>
    </div>
  </div>
  <div class="choose-language">
    <i class="fas fa-globe"></i>
    <div class="select-lang">
      <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <input type="submit" name="en" value="English">
        <input type="submit" name="ar" value="Arabic">
      </form>
    </div>
  </div>
  <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["ratingform"])){
        $name = $_POST["name"];
        $rate = $_POST["rate"];
        if(empty($name) || empty($rate)):
          $_SESSION["RATENAME"] = $name;
        else:
          $stmt = $connect->prepare("SELECT ID FROM rates WHERE Name = ?");
          $stmt->execute([$name]);
          if($stmt->rowCount() == 0):
            $stmt = $connect->prepare("INSERT INTO rates(Name, Rate) VALUES(:name, :rate)");
            $stmt->execute([
              "name" => $name,
              "rate" => $rate
            ]);
            if($stmt->rowCount() > 0):
              $_SESSION["CANNOTRATE"] = $name;
              setcookie("RATED", "Thank you!", strtotime("+ 2 seconds"));
              redirect_within($_SERVER["PHP_SELF"]);
            endif;
          endif;
        endif;
      }
      if(isset($_POST["en"])){
        unset($_SESSION["ARABICLANGUAGE"]);
        redirect_within($_SERVER["PHP_SELF"]);
      }
      if(isset($_POST["ar"])){
        $_SESSION["ARABICLANGUAGE"] = "";
        redirect_within($_SERVER["PHP_SELF"]);
      }
    }
    if(isset($_COOKIE["RATED"])){
      ?>
        <div class="rated">
          <h3>Thank you!</h3>
        </div>
      <?php
    }
  ?>
  <?php 
    if(!isset($_SESSION["CANNOTRATE"])){
      ?>
      <div class="rate dont-show-again" id="rate-box">
        <div class="close-rate-popup">
          <i class="fas fa-times"></i>
        </div>
        <div class="rate-msg">
          <h4><?php echo lang("RATETITLE") ?></h4>
        </div>
        <div class="rate-now">
          <span class="rate-now"><?php echo lang("Rate now") ?></span>
        </div>
        <div class="hide-msg">
          <span class="hide-msg"><?php echo lang("Don't show again") ?></span>
        </div>
        <div class="rate-site-box">
          <div class="box">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
              <div class="input-box">
                <label for=""><?php echo lang("Name") ?><span>*</span></label>
                <input 
                  type="text" 
                  name="name" 
                  value="<?php 
                    $value = isset($_SESSION["RATENAME"]) ? $_SESSION["RATENAME"] : "";
                    echo $value;
                  ?>"
                  autocomplete="off"
                  required>
              </div>
              <h4><?php echo lang("Overall rating") ?></h4>
              <div class="range-number">
                <div class="range-line">
                  <div class="number"><span>1</span></div>
                  <div class="number"><span>2</span></div>
                  <div class="number"><span>3</span></div>
                  <div class="number"><span>4</span></div>
                  <div class="number"><span>5</span></div>
                  <div class="number"><span>6</span></div>
                  <div class="number"><span>7</span></div>
                  <div class="number"><span>8</span></div>
                  <div class="number"><span>9</span></div>
                  <div class="number"><span>10</span></div>
                </div>
              </div>
              <div class="submit">
                <input type="hidden" name="rate" class="rating-number" value="">
                <input type="submit" value="<?php echo lang("Rate") ?>" name="ratingform">
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
    }
  
    include_once $template . "footer.php";
  ob_end_flush();
?>