<?php

require_once '_header.php';
require_once '_utilities.php';

// Add your code here!
function makeGreetingCard($sender,$recipient,$template){
  $file_name = sanitizeFileName("$sender-$recipient.txt");
  $message = file_get_contents("$template");
  /*
  //Using Open and write method to write the file
  $my_file = fopen("cards/$file_name", "w");
  fwrite($my_file, "Dear $recipient,\n");
  fwrite($my_file, "$message\n");
  fwrite($my_file, "Sincerely,\n");
  fwrite($my_file, "$sender");
  fclose($my_file);
*/
  //using short cut method write the file
  $my_file = file_put_contents("cards/$file_name","Dear $recipient,\n\n$message\n\nSincerely,\n$sender");
  //return filename
  return $file_name;
}

//Test makeGreetingCard Function
//makeGreetingCard("Sheriff","Hammed","birthday.txt");

//Check if values is post and assigning the values to variables
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $template  = $_POST['template'];
  //Invoking makeGreetingCard function
    $file_name = makeGreetingCard($sender,$recipient,$template);
    header("Location: /AishaGreeting/card.php?name=$file_name");
    exit;
}
?>

<h1 class="my-4">Create a Greeting Card</h1>
<form method="post">
    <div class="my-3">
        <label for="sender" class="form-label">Sender Name</label>
        <input type="text" name="sender" class="form-control" required>
    </div>

    <div class="my-3">
        <label for="sender" class="form-label">Recipient Name</label>
        <input type="text" name="recipient" class="form-control" required>
    </div>

    <div class="my-3">
        <label for="template" class="form-label">Template</label>
        <select name="template" class="form-select" required>
            <option value="">Choose a Template</option>
            <option value="birthday.txt">Birthday</option>
            <option value="thank_you.txt">Thank You</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-1">Create Card</button>
</form>

<?php

require_once '_footer.php';
