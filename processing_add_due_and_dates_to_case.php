<?php 
// вызывается из page_for_case_card.php
session_start();  
require_once "start_mysql.php"; 	
	
//	print_r($_POST);     
	$id_empl = $_SESSION['userid'];
	$case_id = $_POST['case_id'];

		StartDB();

		if (!empty ($_POST['date_to_first_file']))
		{
			$due_date_id = 1;
			$due_date = $_POST['date_to_first_file'];
//			print "<br>date_to_first_file due_date= ".$due_date."<br>";
			$SQL = "INSERT INTO dates_cases
					(case_id, date_id, date_on_case, recording_date, recorder_id) 
			VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br>date_to_first_file SQL=".$SQL."<br>";
			if (!mysqli_query($db, $SQL)) 
			{
				printf("Ошибка добавления срока date_to_first_file: %s\n", mysqli_error($db));
			}
		}	

		else if (!empty ($_POST['date_to_divisional_file']))
		{
			$due_date_id = 2;
			$due_date = $_POST['date_to_divisional_file'];
//			print "<br>date_to_divisional_file due_date= ".$due_date."<br>";
			$SQL = "INSERT INTO dates_cases
					(case_id, date_id, date_on_case, recording_date, recorder_id) 
			VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br>date_to_divisional_file SQL=".$SQL."<br>";
			if (!mysqli_query($db, $SQL)) 
			{
				printf("Ошибка добавления срока date_to_divisional_file: %s\n", mysqli_error($db));
			}
		}	

// treating first filing events
		else if (!empty ($_POST['domestic_filing_date']))
		{
			$due_date_id = 3;
			$due_date = $_POST['domestic_filing_date'];
			$SQL = "INSERT INTO dates_cases
					(case_id, date_id, date_on_case, recording_date, recorder_id) 
			VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br> domestic_filing_date SQL =".$SQL."<br>";

			if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока domestic_filing_date: %s\n", mysqli_error($db));
				}

			if(!empty ($_POST['check_translation_term']) ){			
				$due_date_id = 4;
				$due_date = $_POST['translation_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> translation_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока translation_term: %s\n", mysqli_error($db));
				}
			}

			if(!empty ($_POST['check_convention_term']) ){			
				$due_date_id = 5;
				$due_date = $_POST['convention_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> convention_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока convention_term: %s\n", mysqli_error($db));
				}
			}

			if(!empty ($_POST['check_examination_term']) ){			
				$due_date_id = 6;
				$due_date = $_POST['examination_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> examination_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока examination_term: %s\n", mysqli_error($db));
				}
			}

			if(!empty ($_POST['check_first_annuity_term']) ){			
				$due_date_id = 7;
				$due_date = $_POST['first_annuity_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> first_annuity_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока first_annuity_term: %s\n", mysqli_error($db));
				}
			}
		}

// treating convention filing 
		else if (!empty ($_POST['priority_date']))
		{
			$due_date_id = 8;
			$due_date = $_POST['priority_date'];
			$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br> priority_date SQL =".$SQL."<br>";

			if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока priority_date: %s\n", mysqli_error($db));
				}

			if(!empty ($_POST['check_convention_term_calculated']) ){			
				$due_date_id = 9;
				$due_date = $_POST['convention_term_calculated'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> convention_term_calculated SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока convention_term_calculated: %s\n", mysqli_error($db));
				}
			}

			if(!empty ($_POST['check_convention_term_client']) ){			
				$due_date_id = 10;
				if(!empty ($_POST['convention_term_client']) ){
				$due_date = $_POST['convention_term_client'];
				}
				else $due_date = date("Y-m-d");
//				print "<br> convention_term_client =".$due_date."<br>";
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> convention_term_client SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока convention_term_client: %s\n", mysqli_error($db));
				}
			}
		}

		// treating international filing events
		else if (!empty ($_POST['pct_filing_date']))
		{
			$due_date_id = 11;
			$due_date = $_POST['pct_filing_date'];
			$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//		print "<br>SQL запись pct_filing_date=".$SQL."<br>";

			if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока pct_filing_date: %s\n", mysqli_error($db));
				}

			$due_date_id = 8;
			if(!empty ($_POST['priority_date_pct']) ){
				$due_date = $_POST['priority_date_pct'];
				}
				else $due_date = $_POST['pct_filing_date'];
			$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//		print "<br>SQL запись priority_date_pct=".$SQL."<br>";

			if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока  priority_date_pct: %s\n", mysqli_error($db));
				}	

			if (!empty ($_POST['checked_national_phase_date_calculated']))
			{
				$due_date_id = 12;
				$due_date = $_POST['national_phase_date_calculated'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> national_phase_date_calculated SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока national_phase_date_calculated: %s\n", mysqli_error($db));
				}
			}	

			if(!empty ($_POST['checked_national_phase_date_client']) ){			
				$due_date_id = 10;
				if(!empty ($_POST['national_phase_date_client']) ){
					$due_date = $_POST['national_phase_date_client'];
					}
					else $due_date = date("Y-m-d");
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> national_phase_date_client SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока national_phase_date_client: %s\n", mysqli_error($db));
				}
			}

			if(!empty ($_POST['checked_pct_amendements_term']) ){			
				$due_date_id = 13;
				$due_date = $_POST['pct_amendements_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> pct_amendements_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока pct_amendements_term: %s\n", mysqli_error($db));
				}
			}
			if(!empty ($_POST['checked_pct_translation_term']) ){			
				$due_date_id = 4;
				$due_date = $_POST['pct_translation_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br>pct_translation_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока pct_translation_term: %s\n", mysqli_error($db));
				}
			}

			if(!empty ($_POST['checked_pct_examination_term']) ){			
				$due_date_id = 6;
				$due_date = $_POST['pct_examination_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> pct_examination_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока pct_examination_term: %s\n", mysqli_error($db));
				}
			}

			if(!empty ($_POST['checked_pct_annuity_term']) ){			
				$due_date_id = 7;
				$due_date = $_POST['pct_annuity_term'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br>pct_annuity_term SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока pct_annuity_term: %s\n", mysqli_error($db));
				}
			}
		}

// treating office action events
		else if (!empty ($_POST['office_action_date']))
		{
			$due_date_id = 14;
			$due_date = $_POST['office_action_date'];
			$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br> office_action_dateSQL=".$SQL."<br>";

			if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока office_action_date: %s\n", mysqli_error($db));
				}

			if (!empty ($_POST['rdue_date_response']))
			{
				$due_date_id = 15;
				$term = $_POST['rdue_date_response'];
				if ($term == 3){$due_date = $_POST['due_date_response3'];}
				else if ($term == 2){$due_date = $_POST['due_date_response2'];}
				else if ($term == 3){$due_date = $_POST['due_date_response3'];}
				else if ($term == 4){$due_date = $_POST['due_date_response4'];}
				else if ($term == 6){$due_date = $_POST['due_date_response6'];}
				else if ($term == 'x'){
					if(!empty ($_POST['due_date_response_free']) ){
						$due_date = $_POST['due_date_response_free'];
						}
						else {$due_date = date("Y-m-d");}
					}
//				print "<br>term = ".$term."<br>";
//				print "<br>due_date_response = ".$due_date."<br>";
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br>due_date_response SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока due_date_response: %s\n", mysqli_error($db));
				}
			}	
			
			if(!empty ($_POST['chfinal_due_date_response']) ){			
				$due_date_id = 16;
				$due_date = $_POST['final_due_date_response'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br>final_due_date_response SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока final_due_date_response: %s\n", mysqli_error($db));
				}
			}
		}

		else if (!empty ($_POST['instructions_date']))
		{
			$due_date_id = 17;
			$due_date = $_POST['instructions_date'];
//				print "<br>instructions_date= ".$due_date."<br>";
			$SQL = "INSERT INTO dates_cases
					(case_id, date_id, date_on_case, recording_date, recorder_id) 
			VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br>instructions_date SQL=".$SQL."<br>";
			if (!mysqli_query($db, $SQL)) 
			{
				printf("Ошибка добавления срока instructions_date: %s\n", mysqli_error($db));
			}
			
			if(!empty ($_POST['instructions_response_date']) ){
				$due_date_id = 18;
				$due_date = $_POST['instructions_response_date'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> instructions_response_date SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
						printf("Ошибка добавления срока instructions_response_date: %s\n", mysqli_error($db));
				}
			}
		}	

		else if (!empty ($_POST['response_date']))
		{
			$due_date_id = 19;
			$due_date = $_POST['response_date'];
//			print "<br>response_date= ".$due_date."<br>";
			$SQL = "INSERT INTO dates_cases
					(case_id, date_id, date_on_case, recording_date, recorder_id) 
			VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br>response_date SQL=".$SQL."<br>";
			if (!mysqli_query($db, $SQL)) 
			{
				printf("Ошибка добавления срока response_date: %s\n", mysqli_error($db));
			}
		}	

		else if (!empty ($_POST['decision_date']))
		{
			$due_date_id = 20;
			$due_date = $_POST['decision_date'];
//			print "<br>decision_date= ".$due_date."<br>";
			$SQL = "INSERT INTO dates_cases
					(case_id, date_id, date_on_case, recording_date, recorder_id) 
			VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br>decision_date SQL=".$SQL."<br>";
			if (!mysqli_query($db, $SQL)) 
			{
				printf("Ошибка добавления срока decision_date: %s\n", mysqli_error($db));
			}

				$term = $_POST['rdecision'];
//				print "<br>term= ".$term."<br>";
				if ($term == 'EA'){
					$due_date_id = 21; 
					$due_date = $_POST['appeal_date'];
//					print "<br>appeal_date= ".$due_date."<br>";
					$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//					print "<br>appeal_date SQL=".$SQL."<br>";
					if (!mysqli_query($db, $SQL)) 
					{
						printf("Ошибка добавления срока appeal_date: %s\n", mysqli_error($db));
					}
				}
				else if ($term == 'RU'){
					$due_date_id = 22; 
					$due_date = $_POST['complain_date'];
//					print "<br>complain_date= ".$due_date."<br>";
					$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//					print "<br>complain_date SQL=".$SQL."<br>";
					if (!mysqli_query($db, $SQL)) 
					{
						printf("Ошибка добавления срока complain_date: %s\n", mysqli_error($db));
					}
			}
			
		}	


// treating office action fees 
		else if (!empty ($_POST['fee_duty_desision_date']))
		{
			$due_date_id = 23;
			$due_date = $_POST['fee_duty_desision_date'];
			$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br>fee_duty_desision_date SQL=".$SQL."<br>";

			if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока fee_duty_desision_date: %s\n", mysqli_error($db));
				}

			if (!empty ($_POST['radio_duty_date']))
			{
				$due_date_id = 24;
				$term = $_POST['radio_duty_date'];
				if ($term == 2){$due_date = $_POST['fee_duty_date_2'];}
				else if ($term == 4){$due_date = $_POST['fee_duty_date_4'];}
				
				else if ($term == 'free'){
					if(!empty ($_POST['fee_duty_date_free']) ){
						$due_date = $_POST['fee_duty_date_free'];
						}
						else {$due_date = date("Y-m-d");}
					}
//				print "<br>term= ".$term."<br>";	
//				print "<br>fee_due_date= ".$due_date."<br>";
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> fee_date SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока fee_due_date: %s\n", mysqli_error($db));
				}
			}

			if (!empty ($_POST['radio_duty_date6']))
				{
					$due_date_id = 25;
					$due_date = $_POST['fee_duty_date_6'];
//					print "<br>fee_due_date 6= ".$due_date."<br>";
					$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//					print "<br>fee_due_date 6 SQL=".$SQL."<br>";
					if (!mysqli_query($db, $SQL)) 
					{
						printf("Ошибка добавления срока fee_due_date_6: %s\n", mysqli_error($db));
					}
				}

				if (!empty ($_POST['radio_duty_date12']))
				{
					$due_date_id = 26;
					$due_date = $_POST['fee_duty_date_12'];
//					print "<br>fee_due_date= ".$due_date."<br>";
					$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//					print "<br>fee_duty_date_12 SQL=".$SQL."<br>";
					if (!mysqli_query($db, $SQL)) 
					{
						printf("Ошибка добавления срока fee_duty_date_12: %s\n", mysqli_error($db));
					}
				}
		}
		
// treating annuities 
		else if (!empty ($_POST['start_patent_term']))
		{
			$due_date_id = 27;
			$due_date = $_POST['start_patent_term'];
			$SQL = "INSERT INTO dates_cases
							(case_id, date_id, date_on_case, recording_date, recorder_id) 
					VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//			print "<br> start_patent_term SQL =".$SQL."<br>";

			if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока start_patent_term: %s\n", mysqli_error($db));
				}

			if(!empty ($_POST['checked_annuity_date']) ){			
				$due_date_id = 7;
				$due_date = $_POST['annuity_date'];
				$SQL = "INSERT INTO dates_cases
						(case_id, date_id, date_on_case, recording_date, recorder_id) 
				VALUES 	('$case_id', '$due_date_id', '$due_date',  Now(), '$id_empl')";	
//				print "<br> annuity_date SQL=".$SQL."<br>";
				if (!mysqli_query($db, $SQL)) 
				{
					printf("Ошибка добавления срока annuity_date: %s\n", mysqli_error($db));
				}
			}
		}


		EndDB();
		header("Refresh: 1; URL = page_for_case_card.php?sent_case_id=$case_id");
	
	
?>

