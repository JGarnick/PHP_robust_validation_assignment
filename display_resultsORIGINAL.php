<?php
    // get the data from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    // get the rest of the data for the form
	$password = filter_input(INPUT_POST, 'password');
	
	$phone_number = filter_input(INPUT_POST, 'phone');

    // for the heard_from radio buttons,
    // display a value of 'Unknown' if the user doesn't select a radio button
	$heard_from = filter_input(INPUT_POST, 'heard_from');
	if ($heard_from == NULL)
		$heard_from = 'Unknown';
	
    // for the wants_updates check box,
    // display a value of 'Yes' or 'No'
	$wants_updates = filter_input(INPUT_POST, 'wants_updates');
	if ($wants_updates == NULL)
		$wants_updates = 'No';
	else if ($wants_updates == 'on')
		$wants_updates = 'Yes';
	
	$contact_via = filter_input(INPUT_POST, 'contact_via');
	
	$comments = filter_input(INPUT_POST, 'comments');
	$message = '';
	
switch ($email)
{
	case '':
		$message = 'Please enter an email address.';
		break;
	case strpos($email, '@', 0) === 0:
		$message = 'Valid emails do not start with a "@". Please enter a valid email.';
		break;
	case strpos($email, '@', 0) > 1:
		$message = 'Valid emails do not have more than 1 "@". Please enter a valid email.';
		break;
	case strpos($email, '@', 0) === FALSE:
		$message = 'Did you forget the "@"?';
		break;
	case strpos($email, '.', 0) === FALSE:
		$message = 'Did you forget the "."?';
		break;
	case strpos($email, '.', 0) === 0:
		$message = 'Valid emails do not start with a ".". Please enter a valid email.';
		break;
	default:
		$message = '';
		break;
}
switch ($password)
{
	case '':
		$message = 'Please enter a password at least 5 characters long.';
		break;
	case strlen($password) < 5:
	case strlen($password) > 12:
		$message = 'Please enter a password between 5 and 12 characters long.';
		break;
	case !ctype_alnum($email):
		$message = 'Passwords must be Upper or lowercase letters or numbers.';
		break;
	default:
		$message = '';
		break;
}
switch ($phone_number)
{
	case '':
		$message = 'Please enter a phone number.';
		break;
	case !ctype_digit($phone_number) :
		$message = 'Phone number must be numbers only.';
		break;							
	case strlen($phone_number) === 7:
		$part1 = substr_replace($phone_number, '-', 3);
		$part2 = substr($phone_number, 3);
		$phone_number = $part1 . $part2;
		echo $phone_number;
		break;
	case strlen($phone_number) === 10:
		$part1 = substr_replace($phone_number, '-', 3);
		$part2 = substr($phone_number, 3);
		$part3 = substr_replace($part2, '-', 3);
		$part4 = substr($phone_number, 6);
		$phone_number = $part1 . $part3 . $part4;				
		break;
	case strlen($phone_number) != 7:
	case strlen($phone_number) != 10:
		$message = 'Phone number must be either 7 or 10 digits long';
		break;
	default:
		$message = '';
		break;
}
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Information</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
<?php if($message = '') : ?>
    <main>
        <h1>Account Information</h1>

        <label>Email Address:</label>
        <span><?php echo htmlspecialchars($email); ?></span><br>

        <label>Password:</label>
        <span><?php echo htmlspecialchars($password); ?></span><br>

        <label>Phone Number:</label>
        <span><?php echo htmlspecialchars($phone_number); ?></span><br>

        <label>Heard From:</label>
        <span><?php echo htmlspecialchars($heard_from); ?></span><br>

        <label>Send Updates:</label>
        <span><?php echo htmlspecialchars($wants_updates); ?></span><br>

        <label>Contact Via:</label>
        <span><?php echo htmlspecialchars($contact_via); ?></span><br><br>

        <span>Comments:</span><br>
        <span><?php echo nl2br(htmlspecialchars($comments)); ?></span><br>        
    </main>
<?php else : ?>
	<main>
		<h1>Attention</h1>
		
		<label>Message</label>
		<span><?php echo htmlspecialchars($message); ?></span><br><br>
	</main>
<?php endif; ?>

</body>
</html>