<?php
include_once '/opt/lampp/htdocs/college-project/lib/load.php';

if (sessions::get("is_logged") && sessions::get("session_token")) {
    if (usersession::authorize(sessions::get("session_token"))) {
        
        // Sanitize and validate input
        $details = [
            'phone' => htmlentities($_POST['idphone']),
            'bio' => htmlentities($_POST['idbio']),
            'profession' => htmlentities($_POST['idprofession']),
            'dob' => htmlentities($_POST['iddob']),
            'city' => htmlentities($_POST['idcity']),
            'country' => htmlentities($_POST['idcountry'])
        ];
        
        $uid = (int) $_POST['uid']; // Ensure the UID is an integer
        
        $dob = DateTime::createFromFormat('Y-m-d', $details['dob']);
        if (!$dob || $dob->format('Y-m-d') !== $details['dob']) {
            echo "Invalid date format for DOB.";
            return;
        }

        // Prepare the SQL query using placeholders
        $sql = "UPDATE `user` SET `phone`=?, `bio`=?, `profession`=?, `dob`=?, `state`=?, `country`=? WHERE `uid`=?";
        
        // Get database connection
        $conn = database::connection();
        
        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the query
            $stmt->bind_param("ssssssi", 
                $details['phone'], 
                $details['bio'], 
                $details['profession'], 
                $details['dob'], 
                $details['city'], 
                $details['country'], 
                $uid
            );
            
            // Execute the query
            try {
                $stmt->execute();
                sessions::load_script("account");
            } catch (Exception $e) {
                // Log the error message to a file instead of displaying it
                error_log("Update error: " . $e->getMessage(), 3, "/var/log/college-project-errors.log");
                sessions::load_script("account");
            }
            
            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the SQL query.";
        }
    }
} else {
    sessions::load_templates('logout');
}
?>