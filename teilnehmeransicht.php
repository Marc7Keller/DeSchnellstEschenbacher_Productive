<!DOCTYPE html>
<html>

<head>
	<title>Administration - Teilnehmeransicht</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_teilnehmer.css" type="text/css">
	<script src="_js/teilnehmer.js" type="text/javascript"></script>

    <?php 
		error_reporting(0);
        include 'php/config.php';
		include 'includes/sessions.php';
    ?>
   
</head>

<body>

	<div id="sitediv">
		
		<a><img id="scdiemberg_logo" src="_img/sportclubdiemberg_logo_klein.png"/></a>
		<a><img id="deschnellsteschenbacher_logo" src="_img/deschnellsteschenbacher_logo_klein.png"/></a>
			
		<?php
            include 'includes/navigation.php';
        ?>
		
		<div id="content">
		
			<?php
				include 'includes/event_selection.php';
			?>
			
			<h1 id="site_title">Teilnehmeransicht</h1></br>
			
			<form id="form_verwaltung" action="" method="GET">
			
				Nachname:*		<input  class="form_cells" type="text" id="nachname_teilnehmeransicht_suche" name="nachname_teilnehmeransicht_suche" value="<?php if(isset($_GET['nachname'])){echo $nachname;}?>"  onblur="colorEmptyField9();" onkeyup="enableLoadButtonNameSearch();"/></br>
				Vorname:*		<input class="form_cells" type="text" id="vorname_teilnehmeransicht_suche" name="vorname_teilnehmeransicht_suche" value="<?php if(isset($_GET['vorname'])){echo $vorname;}?>" onblur="colorEmptyField10();" onkeyup="enableLoadButtonNameSearch();"/></br></br>
    
				<input id="laden_button_name" type="submit" name="laden_button_name_teilnehmeransicht" value="Nach Name suchen" disabled/>
    
			</form>
			
			<form id="form_verwaltung" action="" method="GET">
			
				Startnummer:*	<input id="startnummer_teilnehmeransicht_suche" class="form_cells" type="text" name="startnummer_teilnehmeransicht_suche" value="<?php if(isset($_GET['startnummer'])){echo $startnummer;}?>" onblur="colorEmptyField11();" onkeyup="enableLoadButtonStartnumberSearch();"/></br></br>
    
				<input id="laden_button_startnummer" type="submit" name="laden_button_startnummer_teilnehmeransicht" value="Nach Startnummer suchen" diabled/></br></br>
    
			</form>
	
			<?php
				if(isset($_GET['laden_button_name_teilnehmeransicht']) || isset($_GET['laden_button_startnummer_teilnehmeransicht']))
				{
			?>
			
			<?php
			
				if(isset($_GET['laden_button_name_teilnehmeransicht']))
				{
					$vorname =$_GET['vorname_teilnehmeransicht_suche'];
					$nachname =$_GET['nachname_teilnehmeransicht_suche'];

					$sql = "SELECT * FROM participants INNER JOIN person ON participants.fs_person=person.person_id INNER JOIN class ON participants.fs_class=class.class_id INNER JOIN category ON participants.fs_category=category.category_id INNER JOIN event ON participants.fs_event=event.event_id WHERE person.name = '".$nachname."' and person.firstname= '".$vorname."' && event.event_id= '".$_SESSION['event']."';";
    
					$res = mysqli_query($db,$sql);
    
					if (!$res) 
					{
						printf("Error: %s\n", mysqli_error($db));
						exit();
					}
					
					echo "</br></br>";
					
					if(mysqli_num_rows($res) >= 1)
					{	 
						echo '<table border="1" id="teilnehmeransicht_tabelle">'; 
						echo "<tr><th>Name</th><th>Vorname</th><th>Geburtsjahr</th><th>PLZ</th><th>Ort</th><th>Strasse</th><th>Klasse</th><th>Kategorie</th><th>Startnummer</th><th>Nachanmeldung</th></tr>"; 
					
						while($row = mysqli_fetch_array($res))
						{
							echo '<form action="" method="POST">';
							echo "<tr><td>"; 
							echo $row['name'];
							echo "</td><td>"; 
							echo $row['firstname'];
							echo "</td><td>";   
							echo $row['year_of_birth'];
							echo "</td><td>";    
							echo $row['plz'];
							echo "</td><td>";
							echo $row['place'];
							echo "</td><td>";
							echo $row['street'];
							echo "</td><td>";
							echo $row['class_name'];
							echo "</td><td>";
							echo $row['category_name'];
							echo "</td><td>";
							echo $row['start_number'];
							echo "</td><td>";
							echo $row['late_registration'];
							echo "</td></tr>";
			?>
							<input hidden="text" name="participant_id" value="<?php echo $row['participant_id'];?>"/>
			<?php
							echo "</form>";
						}
					
						echo "</table>";
					}
					else 
					{
						echo "Ihre Suche ergab keine Treffer";
					}
				
				}
			?>
			
			<?php
			
				if(isset($_GET['laden_button_startnummer_teilnehmeransicht']))
				{
					$startnummer = $_GET['startnummer_teilnehmeransicht_suche'];
			
					$sql = "SELECT * FROM participants INNER JOIN person ON participants.fs_person=person.person_id INNER JOIN class ON participants.fs_class=class.class_id INNER JOIN category ON participants.fs_category=category.category_id INNER JOIN event ON participants.fs_event=event.event_id WHERE start_number = '".$startnummer."' && event.event_id= '".$_SESSION['event']."';";
			
					$res = mysqli_query($db,$sql);
    
					if (!$res) 
					{		
						printf("Error: %s\n", mysqli_error($db));
						exit();
					}
    
					echo "</br></br>";
					
					if(mysqli_num_rows($res) >= 1)
					{	 
						echo '<table border="1" id="teilnehmeransicht_tabelle2">'; 
						echo "<tr><th>Name</th><th>Vorname</th><th>Geburtsjahr</th><th>PLZ</th><th>Ort</th><th>Strasse</th><th>Klasse</th><th>Kategorie</th><th>Startnummer</th><th>Nachanmeldung</th></tr>"; 
					
						while($row = mysqli_fetch_array($res))
						{
							echo '<form action="" method="POST">';
							echo "<tr><td>"; 
							echo $row['name'];
							echo "</td><td>"; 
							echo $row['firstname'];
							echo "</td><td>";   
							echo $row['year_of_birth'];
							echo "</td><td>";    
							echo $row['plz'];
							echo "</td><td>";
							echo $row['place'];
							echo "</td><td>";
							echo $row['street'];
							echo "</td><td>";
							echo $row['class_name'];
							echo "</td><td>";
							echo $row['category_name'];
							echo "</td><td>";
							echo $row['start_number'];
							echo "</td><td>";
							echo $row['late_registration'];
							echo "</td></tr>";
			?>
							<input hidden="text" name="participant_id" value="<?php echo $row['participant_id'];?>"/>
			<?php
							echo "</form>";
						}
					
						echo "</table>";
					}
					else 
					{
						echo "Ihre Suche ergab keine Treffer";
					}
				
				}
			?>
		
			<?php
				}
			?>
			
		</div>
		
		<div id="footer">
			<center>
				<?php
					include 'includes/logout.php';
				?>
			</center>
		</div>
		
	</div>
</body>

</html>