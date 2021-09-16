<?php
function login($User_Name,$User_Password)
{
	global $dbh;
	global $salt;
	
	$sql = "SELECT User_Id, User_Name,User_Type,User_Status,User_TypeID,User_ParentId,group_concat(Adb_StateId) as Sta_Id, User_Password,User_Org_Id FROM user_login LEFT JOIN addressbook on user_login.User_Id=addressbook.Adb_UserId WHERE (User_Name = '" .$User_Name. "' OR User_Email = '" .$User_Name. "') ";
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		if($row['User_Status']=="Active")
		{
			if($row['User_Password']==crypt($User_Password, $salt))
			{
				
				$dir = $row['User_Name']."_".$row['User_Id'];
				$documents = "Doc_".$row['User_Name']."_".$row['User_Id'];
				if(!is_dir($dir))
				{
					
					if(mkdir("documents/".$dir,0777))
					{
						@copy(ROOT."user/adminindex.php",ROOT."documents/".$dir."/index.php");
					}
				}
				if(mkdir("documents/".$documents,0777))
				{
					@copy(ROOT."user/adminindex.php",ROOT."documents/$documents/index.php");
				}
				@session_start();
				
				$sqlParentState = "SELECT GROUP_CONCAT(Adb_StateId) as ParentStates FROM addressbook WHERE Adb_UserId='" .$row['User_ParentId']. "'";
				foreach($dbh->query($sqlParentState,PDO::FETCH_ASSOC) as $state)
				{
					$_SESSION['User_ParentStaId'] = $state['ParentStates'];
				}
				
				$_SESSION['documentLink'] = "documents/$documents/";
				$_SESSION['ComplianceLink'] = "documents/".$dir;
				$_SESSION['User_Name'] = $row['User_Name'];
				$_SESSION['User_Id'] = $row['User_Id'];
				setcookie("User_Id", $row['User_Id'], time() + (86400 * 30), "/");
			    $_SESSION['Org_Id'] = $row['User_Org_Id'];
				//setcookie("Org_Id", $row['Org_Id'], time() + (86400 * 30), "/");
				$_SESSION['User_TypeID'] = $row['User_TypeID'];
				$_SESSION['User_ParentId'] = $row['User_ParentId'];
				$_SESSION['Sta_Id'] = $row['Sta_Id'];
				$_SESSION['User_Type']=$row['User_Type'];
				
				$result[0]['status']="true";
				$result[0]['data'] = GetUser($row['User_Id'],"child");
				$result[0]['message']="Logged in successfully."; 
			}
			else
			{
				$result[0]['status']="false";
				$result[0]["message"] = "Username or password not matched.";
			}
		}
		else
		{
			$result[0]['status']="false";
			$result[0]["message"] = "User is still not activated.";
		}
		$i++;
	}
	if($i==0)
	{
		$result[0]['status']="false";
		$result[0]['message'] = "It seems you have never registered on E-Comply please register first.";
	}
	return $result;
}

function LoginDirect($User_Id)
{
	
	
	global $dbh;
	global $salt;
	
	$sql = "SELECT User_Id, User_Name,User_Type,User_Status,User_TypeID,User_ParentId,group_concat(Adb_StateId) as Sta_Id, User_Password,User_Org_Id FROM user_login LEFT JOIN addressbook on user_login.User_Id=addressbook.Adb_UserId WHERE User_Id = '$User_Id'";
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		if($row['User_Status']=="Active")
		{
			//unsetting currently activated sessions
			
			$sqlParentState = "SELECT GROUP_CONCAT(Adb_StateId) as ParentStates FROM addressbook WHERE Adb_UserId='" .$row['User_ParentId']. "'";
		
			foreach($dbh->query($sqlParentState,PDO::FETCH_ASSOC) as $state)
			{
				$_SESSION['User_ParentStaId'] = $state['ParentStates'];
			}
			//return "true";
			 $result[0]['status']="true";
			 $result[0]['data'] = GetUser($row['User_Id'],"child");
			 $result[0]['message']="Logged in successfully."; 
		}
		else
		{
			$result[0]['status']="false";
			$result[0]["message"] = "User is still not activated.";
		}
		$i++;
	}
	if($i==0)
	{
		$result[0]['status']="false";
		$result[0]['message'] = "It seems you have never registered on E-Comply please register first.";
	}
	return $result;
}

function CopyInspection($Ins_From,$Ins_Id)
{
	global $dbh;
	
	
	$sql = "INSERT INTO inspectionquestions ( Iq_InspectionId,Iq_Question,Iq_QuestionType,Iq_Status) SELECT ".$Ins_Id.",Iq_Question,Iq_QuestionType,Iq_Status FROM inspectionquestions WHERE Iq_InspectionId = $Ins_From ";
	$prepare = $dbh->prepare($sql);
	$prepare->execute();
}

function GetUser($User_Id,$child="")
{
	global $dbh;
	$where = "";
	if(!empty($User_Id))
	{
		$where .= " AND User_Id='$User_Id' ";
	}
	
	$sql = "SELECT * FROM user_login left join organization on user_login.User_Org_Id = organization.Org_Id WHERE 1=1 $where ";	
	$result1 = array();
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result1[$i] = $row;
		$result1[$i]['User_Package'] = UserPackageDetail($row['User_Id'],"child");
		$i++;
	}
	if($i==0)
	{
		if(empty($child))
		{
			$result[0]['status']="false";
			$result[0]['message'] = "User not found";
		}
	}
	else
	{
		if(empty($child))
		{
			$result[0]['status']="true";
			$result[0]['data'] = $result1;
			$result[0]['message'] = "User found";
		}
		else
		{
			$result = $result1;
		}
	}
	return $result;
}
function actionitems($Iq_Id,$Iq_CompletedDate, $Iq_CompletedBy, $Iq_Notes)
{
	global $dbh;
	$sql = "UPDATE organization_answers SET Oan_ReplyCompleteDate='".date("Y-m-d", strtotime($Iq_CompletedDate))."', Oan_ReplyUserId='$Iq_CompletedBy', Oan_Reply='$Iq_Notes', Oan_Status='Inactive' WHERE Oan_Id = '$Iq_Id' ";
	$res = $dbh->query($sql);
	if(!empty($res))
	{
		return "Success";
	}
}
function CheckInspectionStatus($Ins_Id)
{
	global $dbh;
	$sql = "SELECT * FROM user_inspections WHERE Ui_UserId='" .$_SESSION['User_Id']. "' AND Ui_InsId='$Ins_Id'";
	$result[0]['Ins_Stauts'] = "Completed";
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result[0]['Ins_Stauts'] = $row['Ui_Status'];
		$result[0]['status'] = "true";
	}
	return $result;
}
function UserPackageDetail($User_Id,$child="")
{
	global $dbh;
	
	$sql = "SELECT Pkg_Name,Pkg_Duration, Pkg_Price, Upkg_StartDate, Upkg_EndDate FROM package_master INNER JOIN users_package ON Pkg_Id=Upkg_PkgID WHERE Upkg_UserID='$User_Id'";
	$result = array();
	$result1 = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result1[$i] = $row;
		$i++;
	}
	if($i==0)
	{
		if(empty($child))
		{
			$result[0]['status']="false";
			$result[0]['message'] = "Package not found";
		}
	}
	else
	{
		if(empty($child))
		{
			$result[0]['status']="true";
			$result[0]['data'] = $result1;
			$result[0]['message'] = "Package found";
		}
		else
		{
			$result=$result1;
		}
	}
	return $result;
}
function GetPackage($Pkg_Id)
{
	global $dbh;
	
	if(!empty($Pkg_Id))
	{
		$where .= " AND Pkg_Id='$Pkg_Id' ";
	}
	
	$sql = "SELECT Pkg_Id, Pkg_Name,Pkg_Price,Pkg_Duration FROM package_master WHERE Pkg_Status='Active' $where ";
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result1[$i] = $row;
		$i++;
	}
	if($i==0)
	{
		$result[0]['status'] = "false";
		$result[0]['message'] = "No package is available";
	}
	else
	{
		$result[0]['status']="true";
		$result[0]['data']=$result1;
		$result[0]['message'] = "Package list found.";
	}
	return $result;
}
function GetBillingCycle($Pkg_Id)
{
	global $dbh;
	$where = "";
	if(!empty($Pkg_Id))
	{
		$where .= " AND Pd_PkgId='$Pkg_Id' ";
	}
	$sql = "SELECT Pd_Id, Pd_PkgId,Pd_Price,Pd_Duration FROM package_duration WHERE 1=1 $where ";
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result1[$i] = $row;
		$i++;
	}
	if($i==0)
	{
		$result[0]['status'] = "false";
		$result[0]['message'] = "No package is available";
	}
	else
	{
		$result[0]['status']="true";
		$result[0]['data']=$result1;
		$result[0]['message'] = "Package list found.";
	}
	return $result;
}
function GetBillingInfo($Pd_Id)
{
	global $dbh;
	$where = "";
	if(!empty($Pd_Id))
	{
		$where .= " AND Pd_Id='$Pd_Id' ";
	}
	
	$sql = "SELECT Pd_Id, Pd_PkgId,Pd_Price,Pd_Duration FROM package_duration WHERE 1=1 $where ";
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result1[$i] = $row;
		$i++;
	}
	if($i==0)
	{
		$result[0]['status'] = "false";
		$result[0]['message'] = "No package is available";
	}
	else
	{
		$result[0]['status']="true";
		$result[0]['data']=$result1;
		$result[0]['message'] = "Package list found.";
	}
	return $result;
}
function GetCountry()
{
	global $dbh;
	$sql = "SELECT Con_Id, Con_Name FROM country WHERE Con_Status='Active'";
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result1[$i] = $row;
		$i++;
	}
	if($i==0)
	{
		$result[0]['status'] = "false";
		$result[0]['message'] = "Country list is not available";
	}
	else
	{
		$result[0]['status']="true";
		$result[0]['data']=$result1;
		$result[0]['message'] = "Country list found.";
	}
	return $result;
}
function GetStates($Con_Id)
{
	global $dbh;
	
	if(!empty($Con_Id))
	{
		$where .=" AND Sta_CountryID='$Con_Id' ";	
	}
	echo $Con_Id;
	$sql = "SELECT Sta_Id, Sta_Name FROM states WHERE Sta_Status='Active' $where";
	$result = array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$result1[$i] = $row;
		$i++;
	}
	if($i==0)
	{
		$result[0]['status'] = "false";
		$result[0]['message'] = "States list is not available";
	}
	else
	{
		$result[0]['status']="true";
		$result[0]['data']=$result1;
		$result[0]['message'] = "States list found.";
	}
	return $result;
}

function ForgotPassword($User_Email)
{
	global $dbh;
	
	$sql = "SELECT User_Id, User_Name, User_Email, User_Status FROM user_login WHERE User_Email = '$User_Email'";
	$i=0;
	$result=array();
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		if($row['User_Status']=="Active")
		{
			$result[0]['status'] = "true";
			$result[0]['data'] = GetUser($row['User_Id'],"child");
			$result[0]['message'] = "Password reset link has been sent to your email address.";
			
			SendForgotpasswordMail(GetUser($row['User_Id'],"child"));
		}
		else
		{
			$result[0]['status']="false";
			$result[0]['message']="User is not activated yet. Please follow the mail link.";
		}
		$i++;
	}
	if($i==0)
	{
		$result[0]['status']="false";
		$result[0]['message'] = "It seems user have not registered on e-comply, please make a new registration first.";
	}
	return $result;
}
function ChangePassword($User_Id,$User_Password)
{
	global $dbh;
	global $salt;
	
	$sql = "SELECT User_Id,User_Name, User_Status,User_Email FROM user_login WHERE User_Id='$User_Id'";
	$result=array();
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		if($row['User_Status']=="Active")
		{
			$sqlUpdate = "UPDATE user_login SET User_Password='" .crypt($User_Password, $salt). "' WHERE User_Id='" .$row['User_Id']. "'";
			$dbh->query($sqlUpdate);
			$result[0]['status'] = "true";
			$result[0]['message'] = "Password has been changed successfully.";
		}
		else
		{
			$result[0]['status']="false";
			$result[0]['message'] = "It seems user is not activated yet. Please follow the mail link.";
		}
		$i++;
	}
	if($i==0)
	{
		$result[0]['status']="false";
		$result[0]['message'] = "It seems user have never registered on e-comply please make a registration first";
	}
	return $result;
}

function Registration($Bil_Email, $Bil_FirstName, $Bil_LastName, $Bil_Company, $Bil_Address, $Bil_Address2, $Bil_Company, $Bil_Phone,$Bil_CountryID, $Bil_ZipCode, $Bil_City, $Bil_StateID, $Bil_PaymentDetail,$Bil_PkgID)
{
	global $dbh;
	global $salt;
	$Pass_Gene = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890"), 0, 6);
	//$User_Password = "123";
	$User_Password = $Pass_Gene;
	$exi = checkExistsUser($Bil_Email, $Bil_FirstName.$Bil_LastName);
	if($exi==0)
	{
		
		$sqlInsertOrganization = "INSERT INTO organization SET Org_UserId= '',Org_PackageID='$Bil_PkgID',Org_DisplayName='$Bil_Company' ,Org_TradingName='$Bil_Company' ,Org_Logo= '',Org_HeadLine='' ,Org_Type='' ,Org_RegNo='' ,Org_EIN='' ,Org_Desc='' ,Org_PostalFind='' ,Org_Address='$Bil_Address' ,Org_Line1= '$Bil_Address2',Org_Line2='' ,Org_CountryId='$Bil_CountryID' ,Org_City= '$Bil_City',Org_PhySame= '',Org_PhyFind= '',Org_PhyAddress='' ,Org_PhyLine1='' ,Org_PhyLine2= '',Org_PhyCountryId= '',Org_PhyCity= '',Org_PhoneCode= '',Org_PhoneNumber= '$Bil_Phone',Org_Email='' ,Org_Website='' ,Org_Status='Active'";
		$dbh->query($sqlInsertOrganization);
		$Org_Id = $dbh->LastInsertId();
		
		$sqlInsertUser = "INSERT INTO user_login SET User_Name='" .$Bil_FirstName.$Bil_LastName ."', User_Email='$Bil_Email', User_Password='".crypt($User_Password, $salt)."', User_TypeID='2', User_Type='orgadmin' ,User_Status='Active',User_PackageID='$Bil_PkgID',User_Org_Id='$Org_Id'";
		$dbh->query($sqlInsertUser);
		$User_Id = $dbh->LastInsertId();
		if($User_Id>0)
		{
			$sqlInsertBilling = "INSERT INTO billinginfo SET Bil_UserID	='$User_Id',Bil_Email='$Bil_Email',Bil_FirstName='$Bil_FirstName',Bil_LastName='$Bil_LastName',Bil_Company='$Bil_Company',Bil_Phone='$Bil_Phone',Bil_Address='$Bil_Address',Bil_Address2='$Bil_Address2',Bil_CountryID='$Bil_CountryID', Bil_ZipCode='$Bil_ZipCode',Bil_City='$Bil_City',Bil_StateID='$Bil_StateID',Bil_PaymentDetails='$Bil_PaymentDetails',Bil_Status='Active'";
			$dbh->query($sqlInsertBilling);
			
			$sqlUserPackage = "INSERT INTO user_package SET Upkg_UserID='$User_Id',Upkg_PkgID='$Bil_PkgID'";
			$dbh->query($sqlUserPackage);
			
			$sqlTraining = "INSERT INTO center SET userlogin_id='$User_Id', centername='$Bil_Company', centeraddress='$Bil_Address', centercode='" .date('Ymd').rand(1111,9999). "' ,email='$Bil_Email', username='".$Bil_FirstName.' '.$Bil_LastName."', password = '".crypt($User_Password, $salt)."', password_md5='$User_Password', center_status='1'";
			$dbh->query($sqlTraining);
			$Center_Id = $dbh->LastInsertId();
			
			$sqlUserCenter = "INSERT INTO user_center SET userlogin_id='$User_Id', c_id='$Center_Id', email='$Bil_Email', username='".$Bil_FirstName.''.$Bil_LastName."', password = '".crypt($User_Password, $salt)."', password_md5='$User_Password', user_status='1'";
			$dbh->query($sqlUserCenter);
			
				//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//$txt = $sqlUserCenter;
//fwrite($myfile, $txt);
//fclose($myfile);
			
			SendRegistrationMail(GetUser($User_Id,"child"),$Pass_Gene);
			
		}
		$result[0]['status']="true";
		$result[0]['message'] = "User registration successfull";
	}
	else
	{
		$result[0]['status']="false";
		$result[0]['message'] = "User is already exists with same email or username.";
	}

	return $result;
}

function checkExistsUser($Email_Id, $User_Name)
{
	global $dbh;
	
	$sql = "SELECT User_Id FROM user_login WHERE User_Email LIKE '$Email_Id' OR User_Name LIKE '$User_Name'";
	$i=0;
	foreach($dbh->query($sql,PDO::FETCH_ASSOC) as $row)
	{
		$i = $row['User_Id'];
	}
	return $i;
}

function ManageAnnouncement($Ann_Id="", $Ann_Title, $Ann_Author, $Ann_Status,$Action="Add")
{
	if($Action=="Add")
	{
		$data = array(
			"Ann_Title"=>$Ann_Title,
			"Ann_Author"=>$Ann_Author,
			"Ann_Status"=>$Ann_Status,
		);
	
		$res = insertDATA($data,'announcement');
		if($res[0]['status']=="false")
		{
			$result = $res;
		}
		else
		{
			$result[0]['status']="true";
			$result = GetAnnouncement($res[0]['Id'],"true");
			$result[0]['message'] = "Announcement added successfully.";
		}
	}
	if($Action=="Update")
	{
		$checkExists = selectDATA('Ann_Id',"announcement","Ann_Id='$Ann_Id'");
		if($checkExists[0]['status']=="false")
		{
			$result[0]['status']="false";
			$result[0]['message']="Announcement not found for this id.";
		}
		else
		{
			$data = array(
				"Ann_Title"=>$Ann_Title,
				"Ann_Author"=>$Ann_Author,
				"Ann_Status"=>$Ann_Status,
			);
		
			$res = updateDATA($data,'announcement',"Ann_Id='$Ann_Id'");
			if($res[0]['status']=="false")
			{
				$result = $res;
			}
			else
			{
				$result[0]['status']="true";
				$result = GetAnnouncement($Ann_Id,"true");
				$result[0]['message'] = "Announcement updated successfully.";
			}
		}
	}
	if($Action=="Delete")
	{
		global $dbh;
		
		$sql = "DELETE FROM announcement WHERE Ann_Id IN ($Ann_Id)";
		$dbh->query($sql);
		$result[0]['status']="true";
		$result[0]['message']="Announcement deleted successfully.";
	}
	return $result;
}

?>

