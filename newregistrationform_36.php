<?php 

        
if(isset($_POST['submit'])){
    $dao = new DAO();
    require_once($_SERVER['DOCUMENT_ROOT']."/main/mpdf60/mpdf.php");

    $timestamp = time();
    $clientId = $client->clientId;
    $target_dir = $GLOBALS['FILE_STORAGE']."/clients/$clientId/files/$timestamp/";
    $name = "studentRegistrationForm_$timestamp".".pdf";

    //if the file name has / or empty spaces replaces them with -
    $name = str_replace("/", "_", $name);
    $name = str_replace(" ", "_", $name);
            
    mkdir($target_dir,755,true);
    $filePath = $target_dir . $name;
    $lang = 'c';
    if(strcmp($client->clientLanguage,"Greek")==0){
        $lang = 'el';
    }
    $mpdf = new mPDF($lang);
    $mainDocument = $reportHeaderPdf.$_POST['data'];
    $mpdf->WriteHTML($mainDocument);
    $mpdf->Output($filePath, "F");
    $file = new File();
    $file->clientId = $client->clientId;
    $file->fileAuthor = $contact->contactId;
    $file->fileIsDir = 0;
    $file->fileLocation = $target_dir;
    $file->fileName = $name;
    $file->fileParentFolder = "none";
    $file->fileStructureId = $student->studentId;
    $file->fileStructureName = "studentRegistrationForm";
    $file->fileUploadDate = date("Y-m-d");
    $fileId = $dao->add($file);
}
$one_address = ($address->firstline ? $address->firstline.',' : '').($address->secondline ? $address->secondline.',' : '').($address->thirdline ? $address->thirdline.',' : '') ;
?>
<form method="post" action="" id="target">
        <style>
    th, td {
     padding: 15px;
    }
</style>
<table style="max-width: 800px; width: 100%; margin: 0 auto;">
        <tbody>
            <tr>
                <td>
                    <table style="width:100%; border-collapse: collapse;" >
                        <tbody>
                        <tr>
                          <th style="text-align: left;"><img style="max-width: 200px;" src="<?php echo $client->clientLogo;?>" alt=""></th>
                          <th>ΑΙΤΗΣΗ ΕΓΓΡΑΦΗΣ ΜΑΘΗΤΗ</th>
                        </tr>
                    </tbody>
                      </table>
                      <table style="width:100%; border-collapse: collapse;" >
                        <tbody>
                          <tr>
                              <td style="padding-right: 0px;">
                                  Τάξη
                              </td>
                              <td style="padding-left: 0px; padding-right: 0px;">
                                  <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                              </td>
                              <td style="padding-left: 0px;">
                                  Αγγλική Γλώσσα για το Σχολικό έτος 2022-2023 
                              </td>
                          </tr>
                          <tr>
                            <td style="padding-right: 0px;">
                                Τάξη
                            </td>
                            <td style="padding-left: 0px; padding-right: 0px;">
                                <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                            </td>
                            <td style="padding-left: 0px;">
                                Γερμανική Γλώσσα για το Σχολικό έτος 2022-2023 
                            </td>
                        </tr>
                        </tbody>
                        </table>
                        <table style="width:100%; margin-top: 20px; border-collapse: collapse;" >
                            <tbody>
                              <tr>
                                  <td style="padding-right: 0px; width: 120px; ">
                                    Επώνυμο μαθητή
                                  </td>
                                  <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                      <?php echo $studentContact->contactFirstName; ?>
                                  </td>
                                  <td style="padding-left: 0px; padding-right: 0px; width: 100px;">
                                    όνομα μαθητή 
                                  </td>
                                  <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php echo $studentContact->contactLastName; ?>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-right: 0px;width: 120px;">
                                    Ημερομηνία γέννησης
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php echo $studentContact->contactDOB; ?>
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                    Τάξη
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                  <?php $edlevel1=$dao->listAllWhere('educationLevel',"WHERE educationLevelId = $student->educationLevelId"); 
                                    $edlevel_name;
                                    foreach($edlevel1 as $e){
                                        $edlevel_name=$e->educationLevelName;
                                    } 
                                        echo $edlevel_name; ?>
                              </td>
                            </tr>
                            </tbody>
                         </table>
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                             
                              <tr>
                                <td style="padding-right: 0px; width: 170px;
                                ">
                                    Ονοματεπώνυμο πατέρα
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php echo $parentContact->contactFirstName; ?>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="padding-right: 0px; width: 170px;
                                ">
                                    Ονοματεπώνυμο μητέρας
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php echo $parentContact2->fullname(); ?>
                                </td>
                                
                            </tr>
                            </tbody>
                         </table>
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                              <tr>
                                  <td style="padding-right: 0px;">
                                    Διεύθυνση κατοικίας
                                  </td>
                                  <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px;border-bottom: 1px dotted #000;">
                                      <?PHP
                                            $address = new Address();
                                            $address->convertToObject($studentContact->contactAddress);
                                            echo '<p class="mb-0">'.$address->firstline.'</p>';
                                            echo '<p class="mb-0">'.$address->secondline.'</p>';
                                            echo '<p class="mb-0">'.$address->thirdline.'</p>';
                                            echo '<p class="mb-0">'.$address->town.'</p>';
                                            echo '<p class="mb-0">'.$address->region.'</p>';
                                            echo '<p class="mb-0">'.$address->zip.'</p>';
                                        ?>
                                  </td>
                                  <td style="padding-left: 0px; padding-right: 0px; width: 130px;">
                                    Περιοχή
                                  </td>
                                  <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?PHP 
                                            $address = new Address();
                                            $address->convertToObject($studentContact->contactAddress);
                                            echo '<p class="mb-0">'.$address->region.'</p>';
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-right: 0px;">
                                    Τ.Κ
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?PHP 
                                            $address = new Address();
                                            $address->convertToObject($studentContact->contactAddress);
                                            echo '<p class="mb-0">'.$address->zip.'</p>';
                                        ?>
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                    τηλέφωνο σταθερό
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                  <?php echo $studentContact->contactPhone; ?>
                              </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 0px;">
                                    Κινητό Πατέρας 
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php echo $parentContact->contactMobile; ?>
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                   e-mail
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                  <?php echo $parentContact->contactEmail; ?>
                              </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 0px;">
                                    Κινητό Πατέρας 
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                    <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                   e-mail
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                  <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                              </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 0px;">
                                    Κινητό Πατέρας 
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                    <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                   e-mail
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                  <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                              </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 0px;">
                                    ΑΦΜ Πατέρα
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php $cc = $dao->get("Contact", $parentContact->contactId, "contactId"); echo $cc->contactStateNumber; ?>
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                    Δ.Ο.Υ. 
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px;">
                                  <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                              </td>
                            </tr>
                            </tbody>
                         </table>
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                             
                              <tr>
                                <td style="padding-right: 0px; width: 130px;">
                                    Επάγγελμα πατέρα
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php echo $parentContact->contactOccupation; ?>
                                </td>
                                
                            </tr>
                           
                            </tbody>
                         </table>
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                                <tr>
                                    <td style="padding-right: 0px; width: 110px;">
                                        ΑΦΜ Μητέρας     
                                    </td>
                                    <td style="width: 290px;padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                        <?php $cc = $dao->get("Contact", $parentContact2->contactId, "contactId"); echo $cc->contactStateNumber; ?>
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px;">
                                        Δ.Ο.Υ. 
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px; ">
                                      <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                                  </td>
                                </tr>
                           
                            </tbody>
                         </table>
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                             
                              <tr>
                                <td style="padding-right: 0px; width: 130px;">
                                    Επάγγελμα μητέρας
                                </td>
                                <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 30px; display: flex; border-bottom: 1px dotted #000;">
                                    <?php echo $parentContact2->contactOccupation; ?>
                                </td>
                                
                            </tr>
                           
                            </tbody>
                         </table>
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                                <tr>
                                    <td>
                                        <b><u>ΔΙΔΑΚΤΡΑ</u></b>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>   
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                                <tr>
                                    <td style="padding-right: 0px; width: 160px;">
                                        ΣΥΝΟΛΟ ΔΙΔΑΚΤΡΩΝ   
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px;">
                                        <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px;">
                                        Αγγλικών
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td style="padding-right: 0px;">
                                        ΣΥΝΟΛΟ ΔΙΔΑΚΤΡΩΝ
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px;">
                                        <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px;">
                                        Γερμανικών
                                    </td>
                                    
                                </tr>
                                
                            </tbody>
                         </table>
                         <table>
                            <tbody>
                                <tr>
                                    <td style="padding-right: 0px; width: 210px; padding-bottom: 0px;">
                                        Τα δίδακτρα είναι πληρωτέα σε 
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px; width: 150px; padding-bottom: 0px;">
                                        <input style="width: 100%; border: 0px; border-bottom: 1px dotted #000;" type="text">
                                    </td>
                                    <td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                                        δόσεις, καταβλητέες μέχρι τέλος του μήνα κάθε 
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td style="padding-top: 0;" colspan="3">μήνα. Υπεύθυνος καταβολής διδάκτρων είναι ο αιτούμενος την εγγραφή γονέας ή κηδεμόνας του σπουδαστή. </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:center;">
                                        <b>ΠΑΡΑΚΑΛΕΙΣΘΕ ΝΑ ΜΑΣ ΕΝΗΜΕΡΩΝΕΤΕ ΓΙΑ ΚΑΘΕ ΑΛΛΑΓΗ ΣΤΟΙΧΕΙΩΝ.</b>
                                    </td>
                                </tr>
                            </tbody>
                         </table>
                         <table style="width:100%;  border-collapse: collapse;" >
                            <tbody>
                               
                                <tr>
                                    <td style="text-align: center;">
                                        Ο ΑΙΤΩΝ/ Η ΑΙΤΟΥΣΑ      
                                    </td>
                                    <td style="text-align: center;">
                                        Ο ΙΔΙΟΚΤΗΤΗΣ ΤΟΥ ΚΞΓ   
                                    </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">
                                            Ονοματεπώνυμο και υπογραφή              
                                        </td>
                                        <td style="text-align: center;">
                                            Γκρεϊση Ειρήνη - Στάσια  
                                        </td>
                                        </tr>
                                    <tbody>

                                    </table>
                </td>
            </tr>
        </tbody>
</table>
    <input type="hidden" name="data" id="data">
    <button class="btn btn-primary" type="submit" name="submit">
        <?php echo $dic->translate("Save");?>
    </button>
</form> 
<script>
    $('input[type="text"]').change(function(){
        $(this).attr('value',$(this).val());
    });
    $('input[type="checkbox"]').change(function(){
        if($(this).is(':checked')){
            $(this).attr('checked','checked');
        }else{
            $(this).removeAttr('checked');
        }
    });
    $('textarea').change(function(){
        $(this).text($(this).val());
    });
    $( "#target" ).submit(function( event ) {
        $("#data").val($("#pdfdata").html());
    });
</script>