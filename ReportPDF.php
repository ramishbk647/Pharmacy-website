<?php 
					require_once __DIR__ . '/vendor/autoload.php';
							$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "pharmacydb";

								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
																	 
							if(isset($_POST['submit'])){
							
							$Fname = $_POST["Fname"];
							$Lname = $_POST["Lname"];
							$Prof = $_POST["prof"];
							$email = $_POST["email"];
							$Fdate = $_POST["fDATE"];
							$selectC = $_POST["selectc"];
							$selectA = $_POST["selectA"];
							$selectG = $_POST["selecctG"];
							$Idegree = $_POST["lDegree"];
							$MatricUCI = $_POST["MatricUCI"];
							$MatricPassingYear = $_POST["MatricPassingYear"];
							$matricCGPA = $_POST["matricCGPA"];
							$matricSpecialization = $_POST["matricSpecialization"];
							$bDegree = $_POST["bDegree"];
							$FScUCI = $_POST["FScUCI"];
							$FscPassingYear = $_POST["FscPassingYear"];
							$FscCGPA = $_POST["FscCGPA"];
							$FscSpecialization = $_POST["FscSpecialization"];
							$cDegree = $_POST["cDegree"];
							$baUCI = $_POST["baUCI"];
							$baPassingYear = $_POST["baPassingYear"];
							$baCGPA = $_POST["baCGPA"];
							$baSpecialization = $_POST["baSpecialization"];
							$dDegree = $_POST["dDegree"];
							$pUCI = $_POST["pUCI"];
							$pPassingYear = $_POST["pPassingYear"];
							$pCGPA = $_POST["pCGPA"];
							$pSpecialization = $_POST["pSpecialization"];
							$eDegree = $_POST["eDegree"];
							$aUCI = $_POST["aUCI"];
							$aPassingYear = $_POST["aPassingYear"];
							$aCGPA = $_POST["aCGPA"];
							$aSpecialization = $_POST["aSpecialization"];
							$ITrateInPakistan = $_POST["ITrateInPakistan"];
							$AIntrst = $_POST["AIntrst"];
							$remarks = $_POST["remarks"];
							
							
								$sql = "INSERT INTO `surveydb`(`FName`, `LName`, `Profession`, `email`, `SurveyDate`, `country`, `ageGroup`, `gender`, `LastDegree`, `MatricUCI`, `MatricPassingYear`, `matricCGPA`, `matricSpecialization`, `2Degree`, `FScUCI`, `FscPassingYear`, `FscCGPA`, `FscSpecialization`, `3Degree`, `baUCI`, `baPassingYear`, `baCGPA`, `baSpecialization`, `4Degree`, `pUCI`, `pPassingYear`, `pCGPA`, `pSpecialization`, `5Degree`, `aUCI`, `aPassingYear`, `aCGPA`, `aSpecialization`, `ITrateInPakistan`, `AIntrst`, `Remarks`) VALUES ('$Fname','$Lname','$Prof','$email','$Fdate','$selectC','$selectA','$selectG','$Idegree','$MatricUCI','$MatricPassingYear','$matricCGPA','$matricSpecialization','$bDegree','$FScUCI','$FscPassingYear','$FscCGPA','$FscSpecialization','$cDegree','$baUCI','$baPassingYear','$baCGPA','$baSpecialization','$dDegree','$pUCI','$pPassingYear','$pCGPA','$pSpecialization','$eDegree','$aUCI','$aPassingYear','$aCGPA','$aSpecialization','$ITrateInPakistan','$AIntrst','$remarks')";
								
							
							$RS = mysqli_query($conn,$sql);
							
 							$conn->close();

						$mpdf = new \Mpdf\Mpdf();
						$data =  "";
						$data .= "<h1 style='text-align: center;'>Survey Report</h1>";
						$data .= "<h3>Personal Detail :</h3>";
						$data .= "<strong>First Name of Surveyor	:	</strong>". $Fname . "<br/>";
						$data .= "<strong>Last Name of Surveyor	:	</strong>". $Lname . "<br/>";
						$data .= "<strong>Profession	:	</strong>".$Prof."<br/>";
						$data .= "<strong>Email Address		:	</strong>" . $email . "<br/>";
						$data .= "<strong>Form Submit Date	:	</strong>" . $Fdate . "<br/>";
						$data .= "<strong>Country	:	</strong>" .$selectC . "<br/>";
						$data .= "<strong>Age Group	:	</strong>" . $selectA . "<br/>";
						$data .= "<strong>Gender	:	</strong>". $selectG . "<br/>";
						
						$data .= "<h3 style='text-align: center;'>Educational Detail</h3>";
						$data .= "<table style='border: 1px solid black;'>
						<tr style='border: 1px solid black;'>
						<td style='border: 1px solid black;'>Degree</td>
						<td style='border: 1px solid black;'>University/College/Institute</td>
						<td style='border: 1px solid black;'>Year of Passing</td>
						<td style='border: 1px solid black;'>%age/CGPA</td>
						<td style='border: 1px solid black;'>Major/ specialization</td>
						</tr>
						<tr style='border: 1px solid black;'>
						<td style='border: 1px solid black;'>Matric</td>
						<td style='border: 1px solid black;'>".$MatricUCI."</td>
						<td style='border: 1px solid black;'>".$MatricPassingYear."</td>
						<td style='border: 1px solid black;'>".$matricCGPA."</td>
						<td style='border: 1px solid black;'>".$matricSpecialization."</td>
						</tr>
						
						<tr style='border: 1px solid black;'>
						<td style='border: 1px solid black;'>FA/F.Sc</td>
						<td style='border: 1px solid black;'>".$FScUCI."</td>
						<td style='border: 1px solid black;'>".$FscPassingYear."</td>
						<td style='border: 1px solid black;'>".$FscCGPA."</td>
						<td style='border: 1px solid black;'>".$FscSpecialization."</td>
						</tr>
						
						<tr style='border: 1px solid black;'>
						<td style='border: 1px solid black;'>B.A/B.Sc</td>
						<td style='border: 1px solid black;'>".$baUCI."</td>
						<td style='border: 1px solid black;'>".$baPassingYear."</td>
						<td style='border: 1px solid black;'>".$baCGPA."</td>
						<td style='border: 1px solid black;'>".$baSpecialization."</td>
						</tr>
						
						<tr style='border: 1px solid black;'>
						<td style='border: 1px solid black;'>Post-Graduation</td>
						<td style='border: 1px solid black;'>".$pUCI."</td>
						<td style='border: 1px solid black;'>".$pPassingYear."</td>
						<td style='border: 1px solid black;'>".$pCGPA."</td>
						<td style='border: 1px solid black;'>".$pSpecialization."</td>
						</tr>
						
						<tr style='border: 1px solid black;'>
						<td style='border: 1px solid black;'>Any other</td>
						<td style='border: 1px solid black;'>".$aUCI."</td>
						<td style='border: 1px solid black;'>".$aPassingYear."</td>
						<td style='border: 1px solid black;'>".$aCGPA."</td>
						<td style='border: 1px solid black;'>".$aSpecialization."</td>
						</tr>
						
						</table>" ."<br/>" ;
						$data .= "<strong style='text-align: center; color:#FF0000'>Future of IT in Pakistan is	:	</strong>". $ITrateInPakistan . "<br/>";
						$data .= "<strong > Area Of Interest	:	</strong>". $AIntrst . "<br/>";
						$data .= "<p style='text-align: justify;'>Remarks of Surveyor	:	</p>". $remarks . "<br/>";
						
						$mpdf->WriteHTML($data);
						
						$mpdf->SetWatermarkText('FUTURE OF IT IN PAKISTAN');
						$mpdf->showWatermarkText = true;
						$mpdf->watermarkTextAlpha = 0.2;
						
						//$newFileName = $Fdate." ".$Fname." ".$Lname.".pdf";
						$newFileName =  rand(1,1000) ." ".$Fname." ".$Lname.".pdf";
						
						$mpdf->Output($newFileName, "F");
						$mpdf->Output($newFileName, "D");
						
						
						
						}
					
 			?>
			
			
			
			
			

 
