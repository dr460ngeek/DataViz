<?php
    
    session_start();
    include './../DB/config.php';

    if (isset($_POST['selected_value'])) {
      $_SESSION['team_id'] = $_POST['selected_value'];

      $p_query = "SELECT player_id FROM player_details WHERE status = 1 LIMIT 1";
      $p_stmt = $conn->prepare($p_query);
                                        
      $p_stmt->execute();
      $p_result = $p_stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($p_result as $p_row) {
          $playerid = $p_row['player_id'];
      }

      header("location: ./index.php?uid=".$_SESSION["team_id"]."&id=".$playerid);
    }
    
    // Get current session value
    $current_value = isset($_SESSION['team_id']) ? $_SESSION['team_id'] : 'Not set';
    echo "<script> console.log($current_value); </script>";

    $currentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $sql = "SELECT player_id FROM player_details WHERE status = 1 Limit 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $fetchId = $result['player_id'];

    if($fetchId != $currentId) {
        // header("location: ./Backend/loading.php?uid=".$_SESSION["team_id"]."&id=".$currentId);
         header("location: ./index.php?uid=".$_SESSION["team_id"]."&id=".$fetchId);

    }
    $sql = "SELECT * FROM player_details WHERE sold_resume = :currentId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":currentId", $currentId, PDO::PARAM_INT);
    $stmt->execute();
   
    
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $sold_unsold = $record['sold_resume'];
    if ($sold_unsold ) {
        echo "<script> let bidButton = document.getElementById('bid-button');
            bidButton.disabled = false;
            bidButton.style.backgroundColor = '#008000';  
            bidButton.style.cursor = 'pointer';</script>";
    }
       
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="refresh" content="3">
    <title>Document</title>
    <link rel="stylesheet" href="./style/style.css">

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="team-details">

            <form method="post" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
              
              <select name="selected_value" onchange="this.form.submit()" style="padding: 8px 12px;
              border-radius: 4px;
              border: 1px solid #ccc;
              font-size: 16px;
              background-color: #93fb9e70;
              font-size: 20px;
              width: 65%;
              color: lightyellow;
            ">
                <?php
                  $team_sql = "SELECT team_id, team_name FROM team";
                  $team_stmt = $conn->prepare($team_sql);
                  $team_stmt->execute();
                  $t_result = $team_stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($t_result as $row) {
                    echo '<option value="' . $row['team_id'] . '"'
                          . (($_SESSION['team_id'] == $row['team_id']) ? ' selected' : '')
                          . '>' . htmlspecialchars($row['team_name']) . '</option>';
                  }             
                  
                ?>
              </select>
              <h2 style="margin: 0; color: #fbdb9c; font-size: 20px;">'s team</h2>
            </form>
            <div class="role-tracker">
                <?php include 'Backend/player_tracker.php'; ?>
            </div>
            
            <div>
                <?php //include 'Backend/player_category.php'; ?>

            </div>  
        </div>

        <div class="hero-section">
            
            <?php include 'Backend/player_details.php'; ?>
        
          <div class="bidding-card">
            <div class="left-section">
              <div class="current-price">
                <span>💰 Current Price</span>
                <span id="current-price-value"></span>
              </div>
              <div class="amount-remaining">
                <span>💵 Purse Remaining</span>
                <span id="amount-remaining-value"></span>
              </div>
            </div>
            <div class="right-section">
              <!-- <div class="timer">
                <span>⏳ Time Left</span>
                <span id="timer">01:00</span>
                <div class="progress-bar">
                  <div id="progress"></div>
                </div>
              </div> -->
              <!-- <button id="bid-button">✨ Bid Now (+₹25 L)</button> -->
              <?php include 'Backend/bidder.php'; ?>
            </div>
          </div>
        
          <!-- Sound Effect for Bid Button -->
          <audio id="bid-sound" src="bid_sound.mp3"></audio>
        </div>

        <div class="bidding-history">
            <div class="bidding-history-container">
                <div class="timer-container">
                    <h2 style="color:#fbdb9c;">📜 Bidding History</h2>
                    <!--<div class='stat-item'><span>TIME:</span> <span id='player-wickets'>90s</span>
                    </div>-->
                </div>

                <!-- <div id="bidding-history" class="bidding-history-box">
                    <p>balboli</p>
                </div> -->

                    <?php include 'Backend/bidding_history.php'; ?>
                    <?php //include 'Backend/button.php'; ?>


            </div>
        </div>
    </div>  
    
        <script src="./script/script.js"></script>
</body>

</html>
