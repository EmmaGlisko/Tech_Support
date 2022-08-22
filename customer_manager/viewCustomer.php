<?php
//author: Tommy O'Heir
//date: 11/9/21
//edited: 12/1/2021

include '../view/header.php';
session_start();
if($_SESSION["type"] == "admin") {
    

// countries array used in form for dropdown menu
$countries = array("AF" => "Afghanistan",
    "AX" => "Åland Islands",
    "AL" => "Albania",
    "DZ" => "Algeria",
    "AS" => "American Samoa",
    "AD" => "Andorra",
    "AO" => "Angola",
    "AI" => "Anguilla",
    "AQ" => "Antarctica",
    "AG" => "Antigua and Barbuda",
    "AR" => "Argentina",
    "AM" => "Armenia",
    "AW" => "Aruba",
    "AU" => "Australia",
    "AT" => "Austria",
    "AZ" => "Azerbaijan",
    "BS" => "Bahamas",
    "BH" => "Bahrain",
    "BD" => "Bangladesh",
    "BB" => "Barbados",
    "BY" => "Belarus",
    "BE" => "Belgium",
    "BZ" => "Belize",
    "BJ" => "Benin",
    "BM" => "Bermuda",
    "BT" => "Bhutan",
    "BO" => "Bolivia",
    "BA" => "Bosnia and Herzegovina",
    "BW" => "Botswana",
    "BV" => "Bouvet Island",
    "BR" => "Brazil",
    "IO" => "British Indian Ocean Territory",
    "BN" => "Brunei Darussalam",
    "BG" => "Bulgaria",
    "BF" => "Burkina Faso",
    "BI" => "Burundi",
    "KH" => "Cambodia",
    "CM" => "Cameroon",
    "CA" => "Canada",
    "CV" => "Cape Verde",
    "KY" => "Cayman Islands",
    "CF" => "Central African Republic",
    "TD" => "Chad",
    "CL" => "Chile",
    "CN" => "China",
    "CX" => "Christmas Island",
    "CC" => "Cocos (Keeling) Islands",
    "CO" => "Colombia",
    "KM" => "Comoros",
    "CG" => "Congo",
    "CD" => "Congo, The Democratic Republic of The",
    "CK" => "Cook Islands",
    "CR" => "Costa Rica",
    "CI" => "Cote D'ivoire",
    "HR" => "Croatia",
    "CU" => "Cuba",
    "CY" => "Cyprus",
    "CZ" => "Czech Republic",
    "DK" => "Denmark",
    "DJ" => "Djibouti",
    "DM" => "Dominica",
    "DO" => "Dominican Republic",
    "EC" => "Ecuador",
    "EG" => "Egypt",
    "SV" => "El Salvador",
    "GQ" => "Equatorial Guinea",
    "ER" => "Eritrea",
    "EE" => "Estonia",
    "ET" => "Ethiopia",
    "FK" => "Falkland Islands (Malvinas)",
    "FO" => "Faroe Islands",
    "FJ" => "Fiji",
    "FI" => "Finland",
    "FR" => "France",
    "GF" => "French Guiana",
    "PF" => "French Polynesia",
    "TF" => "French Southern Territories",
    "GA" => "Gabon",
    "GM" => "Gambia",
    "GE" => "Georgia",
    "DE" => "Germany",
    "GH" => "Ghana",
    "GI" => "Gibraltar",
    "GR" => "Greece",
    "GL" => "Greenland",
    "GD" => "Grenada",
    "GP" => "Guadeloupe",
    "GU" => "Guam",
    "GT" => "Guatemala",
    "GG" => "Guernsey",
    "GN" => "Guinea",
    "GW" => "Guinea-bissau",
    "GY" => "Guyana",
    "HT" => "Haiti",
    "HM" => "Heard Island and Mcdonald Islands",
    "VA" => "Holy See (Vatican City State)",
    "HN" => "Honduras",
    "HK" => "Hong Kong",
    "HU" => "Hungary",
    "IS" => "Iceland",
    "IN" => "India",
    "ID" => "Indonesia",
    "IR" => "Iran, Islamic Republic of",
    "IQ" => "Iraq",
    "IE" => "Ireland",
    "IM" => "Isle of Man",
    "IL" => "Israel",
    "IT" => "Italy",
    "JM" => "Jamaica",
    "JP" => "Japan",
    "JE" => "Jersey",
    "JO" => "Jordan",
    "KZ" => "Kazakhstan",
    "KE" => "Kenya",
    "KI" => "Kiribati",
    "KP" => "Korea, Democratic People's Republic of",
    "KR" => "Korea, Republic of",
    "KW" => "Kuwait",
    "KG" => "Kyrgyzstan",
    "LA" => "Lao People's Democratic Republic",
    "LV" => "Latvia",
    "LB" => "Lebanon",
    "LS" => "Lesotho",
    "LR" => "Liberia",
    "LY" => "Libyan Arab Jamahiriya",
    "LI" => "Liechtenstein",
    "LT" => "Lithuania",
    "LU" => "Luxembourg",
    "MO" => "Macao",
    "MK" => "Macedonia, The Former Yugoslav Republic of",
    "MG" => "Madagascar",
    "MW" => "Malawi",
    "MY" => "Malaysia",
    "MV" => "Maldives",
    "ML" => "Mali",
    "MT" => "Malta",
    "MH" => "Marshall Islands",
    "MQ" => "Martinique",
    "MR" => "Mauritania",
    "MU" => "Mauritius",
    "YT" => "Mayotte",
    "MX" => "Mexico",
    "FM" => "Micronesia, Federated States of",
    "MD" => "Moldova, Republic of",
    "MC" => "Monaco",
    "MN" => "Mongolia",
    "ME" => "Montenegro",
    "MS" => "Montserrat",
    "MA" => "Morocco",
    "MZ" => "Mozambique",
    "MM" => "Myanmar",
    "NA" => "Namibia",
    "NR" => "Nauru",
    "NP" => "Nepal",
    "NL" => "Netherlands",
    "AN" => "Netherlands Antilles",
    "NC" => "New Caledonia",
    "NZ" => "New Zealand",
    "NI" => "Nicaragua",
    "NE" => "Niger",
    "NG" => "Nigeria",
    "NU" => "Niue",
    "NF" => "Norfolk Island",
    "MP" => "Northern Mariana Islands",
    "NO" => "Norway",
    "OM" => "Oman",
    "PK" => "Pakistan",
    "PW" => "Palau",
    "PS" => "Palestinian Territory, Occupied",
    "PA" => "Panama",
    "PG" => "Papua New Guinea",
    "PY" => "Paraguay",
    "PE" => "Peru",
    "PH" => "Philippines",
    "PN" => "Pitcairn",
    "PL" => "Poland",
    "PT" => "Portugal",
    "PR" => "Puerto Rico",
    "QA" => "Qatar",
    "RE" => "Reunion",
    "RO" => "Romania",
    "RU" => "Russian Federation",
    "RW" => "Rwanda",
    "SH" => "Saint Helena",
    "KN" => "Saint Kitts and Nevis",
    "LC" => "Saint Lucia",
    "PM" => "Saint Pierre and Miquelon",
    "VC" => "Saint Vincent and The Grenadines",
    "WS" => "Samoa",
    "SM" => "San Marino",
    "ST" => "Sao Tome and Principe",
    "SA" => "Saudi Arabia",
    "SN" => "Senegal",
    "RS" => "Serbia",
    "SC" => "Seychelles",
    "SL" => "Sierra Leone",
    "SG" => "Singapore",
    "SK" => "Slovakia",
    "SI" => "Slovenia",
    "SB" => "Solomon Islands",
    "SO" => "Somalia",
    "ZA" => "South Africa",
    "GS" => "South Georgia and The South Sandwich Islands",
    "ES" => "Spain",
    "LK" => "Sri Lanka",
    "SD" => "Sudan",
    "SR" => "Suriname",
    "SJ" => "Svalbard and Jan Mayen",
    "SZ" => "Swaziland",
    "SE" => "Sweden",
    "CH" => "Switzerland",
    "SY" => "Syrian Arab Republic",
    "TW" => "Taiwan, Province of China",
    "TJ" => "Tajikistan",
    "TZ" => "Tanzania, United Republic of",
    "TH" => "Thailand",
    "TL" => "Timor-leste",
    "TG" => "Togo",
    "TK" => "Tokelau",
    "TO" => "Tonga",
    "TT" => "Trinidad and Tobago",
    "TN" => "Tunisia",
    "TR" => "Turkey",
    "TM" => "Turkmenistan",
    "TC" => "Turks and Caicos Islands",
    "TV" => "Tuvalu",
    "UG" => "Uganda",
    "UA" => "Ukraine",
    "AE" => "United Arab Emirates",
    "GB" => "United Kingdom",
    "US" => "United States",
    "UM" => "United States Minor Outlying Islands",
    "UY" => "Uruguay",
    "UZ" => "Uzbekistan",
    "VU" => "Vanuatu",
    "VE" => "Venezuela",
    "VN" => "Viet Nam",
    "VG" => "Virgin Islands, British",
    "VI" => "Virgin Islands, U.S.",
    "WF" => "Wallis and Futuna",
    "EH" => "Western Sahara",
    "YE" => "Yemen",
    "ZM" => "Zambia",
    "ZW" => "Zimbabwe");
?>
<style>
    label {
      width: 150px;
      padding-right: 20px;
      padding: 5px;
      display: inline-block;
    }
</style>
<main>

<?php require('../model/database.php');

if (isset($_GET['customerID'])) {
    //Get cusotmerID through query string param
    $selectedID = $_GET['customerID'];
    // if a customer has been selected, run a query to select them and display their info in the form
    try{
        // Perform SQL query
        $query = mysqli_prepare($con, "SELECT * FROM customers WHERE customerID = ?");
        mysqli_stmt_bind_param($query, "s", $selectedID);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
    } catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    
    // display result in form
    echo '<h3>Update Customer</h3>';
    echo '<form method="post" action="updateCustomer.php">';
    while($row = $result->fetch_assoc()) {
        echo "<input type='hidden' name='customerID' value='". $row["customerID"]."'>";
        echo "<label>First Name: </label><input type='text' name='firstName' value='". $row["firstName"]."' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
        echo "<label>Last Name: </label><input type='text' name='lastName' value='". $row["lastName"]."' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
        echo "<label>Address: </label><input type='text' name='address' value='". $row["address"]."' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
        echo "<label>City: </label><input type='text' name='city' value='". $row["city"]."' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
        echo "<label>State: </label><input type='text' name='state' value='". $row["state"]."' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
        echo "<label>Postal Code: </label><input type='text' name='postalCode' value='". $row["postalCode"]."' required pattern='.{1,20}' title='Must be 1 to 20 characters.'><br>";
        echo "<label>Country Code: </label>
          <select name='countryCode'>";
        foreach ($countries as $key => $val){
            echo "<option value='$key'>$val</option>";
        }
        
        echo "</select><br>";
        echo "<label>Phone: </label><input type='tel' name='phone' value='". $row["phone"]."' pattern='[(][0-9]{3}[)] [0-9]{3}-[0-9]{4}' ><br>";
        echo "<label>Email: </label><input type='email' name='email' value='". $row["email"]."' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' required minlength='1' maxlength='50'><br>";
        echo "<label>Password: </label><input type='text' name='password' value='". $row["password"]."' pattern='.{6,20}' title='Must be 6 to 10 characters.'><br>";
        
    }
    echo '<input type="submit" value="Update">
      </form>';
    
    mysqli_close($con);
    
} else {
  // if no customer has been selected, allow the user to add a customer
  echo '<h3>Add a Customer</h3>';
  
  echo '<form method="post" action="updateCustomer.php">';
      echo "<label>First Name: </label><input type='text' name='firstName' value='' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
      echo "<label>Last Name: </label><input type='text' name='lastName' value='' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
      echo "<label>Address: </label><input type='text' name='address' value='' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
      echo "<label>City: </label><input type='text' name='city' value='' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
      echo "<label>State: </label><input type='text' name='state' value='' required pattern='.{1,50}' title='Must be 1 to 50 characters.'><br>";
      echo "<label>Postal Code: </label><input type='text' name='postalCode' value='' required pattern='.{1,20}' title='Must be 1 to 20 characters.'><br>";
      echo "<label>Country Code: </label>
          <select name='countryCode'>";
      foreach ($countries as $key => $val){
          echo "<option value='$key'>$val</option>";
      }
      echo "</select><br>";
      echo "<label>Phone: </label><input type='tel' name='phone' value='' pattern='[(][0-9]{3}[)] [0-9]{3}-[0-9]{4}' title='Must use this format: (111) 111-1111 '><br>";
      echo "<label>Email: </label><input type='email' name='email' value='' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' required minlength='1' maxlength='50'><br>";
      echo "<label>Password: </label><input type='text' name='password' value='' pattern='.{6,20}' title='Must be 6 to 10 characters.'><br>";
      
  echo '<input type="submit" value="Add Customer">
      </form>';
  
}

?>



<br><a href='index.php'>Search Customers</a>
</main>
<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>