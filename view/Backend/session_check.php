<?php
    include '../DB/config.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sessionValue'])) {
        // Sanitize the input to prevent security issues
        // $selectedValue = htmlspecialchars($_POST['sessionValue']);
    
        // // Update the session variable
        // $_SESSION['team_id'] = $selectedValue;
    
        // Optionally, send a response back to the client
        //echo 'Session variable updated successfully to ' . $selectedValue;
        
        // $selectedValue = $_POST['sessionValue'];

        // Update the session ID
        // $oldSessionId = session_id();
        // session_regenerate_id(false);
        // $newSessionId = session_id();

        // $_SESSION["team_id"] = $selectedValue;
        // echo "<script> console.log($selectedValue) </script>";

        $p_query = "SELECT player_id FROM player_details WHERE status = 1 LIMIT 1";
        $p_stmt = $conn->prepare($p_query);
                                        
        $p_stmt->execute();
        $p_result = $p_stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($p_result as $p_row) {
            $playerid = $p_row['player_id'];
        }

        header("location: ./index.php?uid=".$_SESSION["team_id"]."&id=".$playerid);
    }  
    else  
    {  
        header("location: ./Backend/login.php");  
    }
?>