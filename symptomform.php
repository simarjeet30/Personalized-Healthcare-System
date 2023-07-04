<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fever and Symptoms Checker</title>
  <style>
    /* Style for the form and its elements */
    form {
      width: 50%;
      margin: 0 auto;
      padding: 20px;
      border: 2px solid #ccc;
      border-radius: 10px;
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input[type="submit"] {
      display: block;
      margin: 20px auto 0;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="checkbox"] {
      margin-right: 10px;
      display:inline-block;
    }
    /* Style for the results */
    #results {
      width: 50%;
      margin: 20px auto;
      padding: 20px;
      border: 2px solid #ccc;
      border-radius: 10px;
    }
    #results h2 {
      margin-top: 0;
    }
   .check{
       margin-top: 10px;
   }
  </style>

<link rel="stylesheet" href="website.css">
</head>


<body>

<header>
        <h1>Personalised Healthcare System</h1>
        <h4>Keep track of your health</h4>
</header>

<div class="navbar">
<?php 

session_start();

if (isset($_SESSION['uid'])) {

 ?>
     <h4>Hello, <?php echo $_SESSION['uid']; ?></h4>

     <a href="logout.php">Logout</a>

<?php
}
?>

<a href="website1.php" >Home</a>

<?php 

if (!isset($_SESSION['uid'])) {

 ?>

     <a href="login.html">Register/Sign In</a>

<?php
}
?>

<a href="entry1.php">COVID checker</a>

<a href="data.php">All patient data</a>

<a href="userdata.php">User data</a>

<a href="room.php">Room conditions</a>

</div>

  <form id="symptom-checker">
    <h1>Symptoms Checker</h1>
    <label for="fever">Fever:</label>
    <input type="checkbox" name="fever" value="low">Low
    <input type="checkbox" name="fever" value="high">High
    <label class="check" for="symptoms">Symptoms:</label>
    <input type="checkbox" name="symptoms" value="cough">Cough<br>
    <input type="checkbox" name="symptoms" value="skin-rashes">Skin rashes<br>
    <input type="checkbox" name="symptoms" value="nausea-vomiting">Nausea and vomiting<br>
    <input type="checkbox" name="symptoms" value="swelling-of-the-lips-face-or-tongue">Swelling of the lips, face, or tongue<br>
    <input type="checkbox" name="symptoms" value="Itchiness">Itchiness<br>
    <input type="checkbox" name="symptoms" value="Fainting">Fainting<br>
    <input type="checkbox" name="symptoms" value="Eye-irritation">Eye irritation<br>
    <input type="checkbox" name="symptoms" value="Puffy-watery-eyes">Puffy, watery eyes<br>
    <input type="checkbox" name="symptoms" value="sore-throat">Sore Throat<br>
    <input type="checkbox" name="symptoms" value="inflamed-itchy-nose-and-throat">inflamed,itchy nose and throat<br>
    <input type="checkbox" name="symptoms" value="Sneezing">Sneezing<br>
    <input type="checkbox" name="symptoms" value="runny-nose">Runny Nose<br>
    <input type="checkbox" name="symptoms" value="fatigue">Fatigue<br>
    <input type="checkbox" name="symptoms" value="headache">Headache<br>
    <input type="checkbox" name="symptoms" value="body-aches"> Body Aches<br>
    <input type="checkbox" name="symptoms" value="shortness-of-breath">Shortness of Breath<br>
    <input type="checkbox" name="symptoms" value="loss-of-smell-taste">Loss of Smell/Taste<br>
    <input type="checkbox" name="symptoms" value="loose-stools">Watery, loose stools<br>
    <input type="checkbox" name="symptoms" value="bowel-movements">Frequent bowel movements<br>
    <input type="checkbox" name="symptoms" value="abdomen-pain">Abdomen pain
    <input type="submit" value="Check" name="check">
  </form>
  <div id="results"></div>
<script>
  const form = document.querySelector('#symptom-checker');
  const results = document.querySelector('#results');

  form.addEventListener('submit', function(event) {
    event.preventDefault(); // prevent form submission
    const formData = new FormData(form);
    const checkedSymptoms = [];

    // check which symptoms are checked and add them to an array
    for (const checkbox of formData.getAll('symptoms')) {
      checkedSymptoms.push(checkbox);
    }

    // determine possible diseases based on the selected checkboxes
    let possibleDiseases = [];
    if (checkedSymptoms.includes('Eye-irritation') ||checkedSymptoms.includes('runny-nose') ||checkedSymptoms.includes('Puffy-watery-eyes') ||checkedSymptoms.includes('Sneezing') || checkedSymptoms.includes('inflamed-itchy-nose-and-throat')) {
      possibleDiseases.push('Allergy from pollen and pet dander');
    } 
    if (checkedSymptoms.includes('skin-rashes') || checkedSymptoms.includes('nausea-vomiting') || checkedSymptoms.includes('swelling-of-the-lips-face-or-tongue') || checkedSymptoms.includes('Itchiness') || checkedSymptoms.includes('shortness-of-breath') || checkedSymptoms.includes('Fainting')) {
      possibleDiseases.push('Allergy from food and other medications');
    }
    if (formData.get('fever') === 'high' || checkedSymptoms.includes('headache') || checkedSymptoms.includes('fatigue') || checkedSymptoms.includes('cough')) {
      possibleDiseases.push('Cold and Flu');
    }
    if (checkedSymptoms.includes('bowel-movements') || checkedSymptoms.includes('loose-stools') || checkedSymptoms.includes('abdomen-pain')) {
      possibleDiseases.push('Diarrhea');
    }

    // display the results
    if (possibleDiseases.length === 0) {
      results.innerHTML = '<p>No possible diseases based on the selected symptoms.</p>';
    } else {
      let resultText = '<h2>Possible Diseases:</h2><ul>';
      for (const disease of possibleDiseases) {
        resultText += `<li>${disease}</li>`;
      }
      resultText += '</ul>';
      results.innerHTML = resultText;
    }
  });
</script>

</body>
</html>