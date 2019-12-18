<html>
  <head>
    <meta charset="UTF-8">
    <title>Добавяне на избираема дисциплина</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div id="container">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        Име на дисциплина
        <textarea rows="4" name="electiveName" required></textarea>
        <span class="error"><?php echo $electiveNameErr;?></span>

        Преподавател
        <textarea rows="3" name="lecturer" required></textarea>
        <span class="error"><?php echo $lecturerErr;?></span>

        Описание
        <textarea rows="5" name="description" required></textarea>
        <span class="error"><?php echo $descriptionErr;?></span>

        Група
        <select name="electiveGroup">
          <option selected></option>
          <option value="ОКН">ОКН</option>
          <option value="ЯКН">ЯКН</option>
          <option value="ПМ">ПМ</option>
          <option value="М">М</option>
        </select>

        Кредити
        <input type="text" name="credits"/>
        <span class="error"><?php echo $creditsErr;?></span>

        <input type="submit" value="Добавяне">
      </form>
    </div>
  </body>
</html>

  <?php
    $electiveNameErr = $lecturerErr = $descriptionErr = $creditsErr "";
    $electiveName = $lecturer = $description = $group = $credits = null;
    if ($_POST) {
    if (empty($_POST['electiveName']) {
      $electiveNameErr = "Името на дисциплината е задължително";
    } else {
      $electiveName = $_POST['electiveName'])
      if (strlen($electiveName) > 150) {

      }
    }
  	  $electiveName = $_POST['electiveName'];
  	  $lecturer = $_POST['lecturer'];
  	  $description = $_POST['description'];

      $electiveGroup = null;
  	if (!empty($_POST['electiveGroup'])) {
  	    $electiveGroup = $_POST['electiveGroup'];
  	}

  	$credits = null;
  	if (!empty($_POST['credits'])) {
  		$credits = $_POST['credits'];
  	}

  	$conn = new PDO('mysql:host=localhost:3306;dbname=electives', 'root', '');
  	$stmt = $conn->prepare("INSERT INTO electives (elective_name, lecturer, description, elective_group, credits)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$electiveName, $lecturer, $description, $electiveGroup, $credits]);
  }
  ?>

  <?php
  // define variables and set to empty values
  $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $name = $email = $gender = $comment = $website = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
        $websiteErr = "Invalid URL";
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }


  }
  ?>
