<?php

namespace Dcplibrary\PAPIAccount\App\Livewire\Forms;

use Dcplibrary\PAPIAccount\App\Concerns\DateConcerns;
use Livewire\Attributes\Session;
use Livewire\Form;

class PatronForm extends Form
{
    use DateConcerns;

    #[Session(key: 'AccessSecret')]
    public $AccessSecret = '';

    public $Password = '';

    #[Session(key: 'PatronID')]
    public $PatronID = '';

    #[Session(key: 'Barcode')]
    public $Barcode = '';

    #[Session(key: 'NameFirst')]
    public $NameFirst = '';

    #[Session(key: 'NameLast')]
    public $NameLast = '';

    #[Session(key: 'NameMiddle')]
    public $NameMiddle = '';

    #[Session(key: 'PhoneVoice1')]
    public $PhoneVoice1 = '';

    #[Session(key: 'EmailAddress')]
    public $EmailAddress = '';

    #[Session(key: 'NameSuffix')]
    public $NameSuffix = '';

    #[Session(key: 'Phone1CarrierID')]
    public $Phone1CarrierID = '';

    #[Session(key: 'CellPhone')]
    public $CellPhone = '';

    #[Session(key: 'CellPhoneCarrierID')]
    public $CellPhoneCarrierID = '';

    #[Session(key: 'BirthDate')]
    public $BirthDate = '';

    #[Session(key: 'RegistrationDate')]
    public $RegistrationDate = '';

    #[Session(key: 'LastActivityDate')]
    public $LastActivityDate = '';

    #[Session(key: 'AddrCheckDate')]
    public $AddrCheckDate = '';

    #[Session(key: 'PatronCodeID')]
    public $PatronCodeID = '';

    #[Session(key: 'patronCode')]
    public $patronCode = '';

    #[Session(key: 'DeliveryOptionID')]
    public $DeliveryOptionID = '';

    #[Session(key: 'TxtPhoneNumber')]
    public $TxtPhoneNumber = '';

    #[Session(key: 'ExpirationDate')]
    public $ExpirationDate = '';

    #[Session(key: 'User1')]
    public $User1 = '';

    #[Session(key: 'User2')]
    public $User2 = '';

    #[Session(key: 'User3')]
    public $User3 = '';

    #[Session(key: 'User4')]
    public $User4 = '';

    #[Session(key: 'User5')]
    public $User5 = '';

    #[Session(key: 'FormerID')]
    public $FormerID = '';

    #[Session(key: 'AddressID')]
    public $AddressID = '';

    #[Session(key: 'StreetOne')]
    public $StreetOne = '';

    #[Session(key: 'StreetTwo')]
    public $StreetTwo = '';

    #[Session(key: 'City')]
    public $City = '';

    #[Session(key: 'State')]
    public $State = '';

    #[Session(key: 'County')]
    public $County = '';

    #[Session(key: 'PostalCode')]
    public $PostalCode = '';

    #[Session(key: 'Country')]
    public $Country = '';

    // Notes
    #[Session(key: 'NonBlockingBranchID')]
    public $NonBlockingBranchID = '';

    #[Session(key: 'NonBlockOrgName')]
    public $NonBlockOrgName = '';

    #[Session(key: 'NonBlockingUserID')]
    public $NonBlockingUserID = '';

    #[Session(key: 'NonBlockUsrName')]
    public $NonBlockUsrName = '';

    #[Session(key: 'NonBlockingWorkstationID')]
    public $NonBlockingWorkstationID = '';

    #[Session(key: 'DisplayName')]
    public $DisplayName = '';

    #[Session(key: 'BlockingBranchID')]
    public $BlockingBranchID = '';

    #[Session(key: 'BlockingOrgName')]
    public $BlockingOrgName = '';

    #[Session(key: 'BlockingUserID')]
    public $BlockingUserID = '';

    #[Session(key: 'BlockingUsrName')]
    public $BlockingUsrName = '';

    #[Session(key: 'BlockingWorkstationID')]
    public $BlockingWorkstationID = '';

    #[Session(key: 'BlockingWorkstationDisplayName')]
    public $BlockingWorkstationDisplayName = '';

    #[Session(key: 'NonBlockingStatusNotes')]
    public $NonBlockingStatusNotes = '';

    #[Session(key: 'NonBlockingStatusNoteDate')]
    public $NonBlockingStatusNoteDate = '';

    #[Session(key: 'BlockingStatusNotes')]
    public $BlockingStatusNotes = '';

    #[Session(key: 'BlockingStatusNoteDate')]
    public $BlockingStatusNoteDate = '';

    #[Session(key: 'displayableBirthDate')]
    public $displayableBirthDate = '';

    #[Session(key: 'displayableRegistrationDate')]
    public $displayableRegistrationDate = '';

    #[Session(key: 'displayableLastActivityDate')]
    public $displayableLastActivityDate = '';

    #[Session(key: 'displayableAddrCheckDate')]
    public $displayableAddrCheckDate = '';

    #[Session(key: 'displayableExpirationDate')]
    public $displayableExpirationDate = '';

    #[Session(key: 'daysToExpiration')]
    public $daysToExpiration = '';

    #[Session(key: 'isRenewable')]
    public $isRenewable = false;

    #[Session(key: 'photoUploaded')]
    public $photoUploaded = false;

    public function setPatronData($basicData): void
    {
        $this->PatronID = $basicData['PatronID'];
        $this->Barcode = $basicData['Barcode'];
        $this->NameFirst = $basicData['NameFirst'];
        $this->NameLast = $basicData['NameLast'];
        $this->NameMiddle = $basicData['NameMiddle'];
        $this->PhoneVoice1 = $basicData['PhoneNumber'];
        $this->EmailAddress = $basicData['EmailAddress'];
        $this->NameSuffix = $basicData['NameSuffix'];
        $this->Phone1CarrierID = $basicData['Phone1CarrierID'];
        $this->CellPhone = $basicData['CellPhone'];
        $this->CellPhoneCarrierID = $basicData['CellPhoneCarrierID'];
        $this->BirthDate = $this->formatToDateString($basicData['BirthDate']);
        $this->displayableBirthDate = $this->displayableDate($this->BirthDate);

        $this->RegistrationDate = $this->formatToDateString($basicData['RegistrationDate']);
        $this->displayableRegistrationDate = $this->displayableDate($this->RegistrationDate);
        $this->LastActivityDate = $this->formatToDateString($basicData['LastActivityDate']);
        $this->displayableLastActivityDate = $this->displayableDate($this->LastActivityDate);
        $this->AddrCheckDate = $this->formatToDateString($basicData['AddrCheckDate']);
        $this->displayableAddrCheckDate = $this->displayableDate($this->AddrCheckDate);
        $this->PatronCodeID = $basicData['PatronCodeID'];
        $this->patronCode = $this->getPatronCode($this->PatronCodeID);
        $this->DeliveryOptionID = $basicData['DeliveryOptionID'];
        $this->TxtPhoneNumber = $basicData['TxtPhoneNumber'];
        $this->ExpirationDate = $this->formatToDateString($basicData['ExpirationDate']);
        $this->displayableExpirationDate = $this->displayableDate($this->ExpirationDate);

        $this->User1 = $basicData['User1'];
        $this->User2 = $basicData['User2'];
        $this->User3 = $basicData['User3'];
        $this->User4 = $basicData['User4'];
        $this->User5 = $basicData['User5'];
        $this->FormerID = $basicData['FormerID'];
        $this->setPatronAddress($basicData['PatronAddresses'][0]);
        $this->setPatronNotes($basicData['PatronNotes']);
    }

    public function setPatronAddress($patronAddress): void
    {
        $this->AddressID = $patronAddress['AddressID'];
        $this->StreetOne = $patronAddress['StreetOne'];
        $this->StreetTwo = $patronAddress['StreetTwo'];
        $this->City = $patronAddress['City'];
        $this->County = $patronAddress['County'];
        $this->State = $patronAddress['State'];
        $this->PostalCode = $patronAddress['PostalCode'];
        $this->Country = $patronAddress['Country'];
    }

    public function setPatronNotes($patronNotes): void
    {
        $this->NonBlockingBranchID = $patronNotes['NonBlockingBranchID'];
        $this->NonBlockOrgName = $patronNotes['NonBlockOrgName'];
        $this->NonBlockingUserID = $patronNotes['NonBlockingUserID'];
        $this->NonBlockUsrName = $patronNotes['NonBlockUsrName'];
        $this->NonBlockingWorkstationID = $patronNotes['NonBlockingWorkstationID'];
        $this->DisplayName = $patronNotes['DisplayName'];
        $this->BlockingBranchID = $patronNotes['BlockingBranchID'];
        $this->BlockingOrgName = $patronNotes['BlockingOrgName'];
        $this->BlockingUserID = $patronNotes['BlockingUserID'];
        $this->BlockingUsrName = $patronNotes['BlockingUsrName'];
        $this->BlockingWorkstationID = $patronNotes['BlockingWorkstationID'];
        $this->BlockingWorkstationDisplayName = $patronNotes['BlockingWorkstationDisplayName'];
        $this->NonBlockingStatusNotes = $patronNotes['NonBlockingStatusNotes'];
        $this->NonBlockingStatusNoteDate = $patronNotes['NonBlockingStatusNoteDate'];
        $this->BlockingStatusNotes = $patronNotes['BlockingStatusNotes'];
        $this->BlockingStatusNoteDate = $patronNotes['BlockingStatusNoteDate'];
    }

    public function getPatronCode($id): string
    {
        $patronCodes = [
            '1' => 'Adult Courtesy',
            '2' => 'Adult Paid',
            '3' => 'Adult',
            '4' => 'Bulk Loan Institutions',
            '5' => 'Business Use Only',
            '7' => 'Homebound',
            '8' => 'ILL',
            '9' => 'Juvenile Courtesy',
            '11' => 'Juvenile Paid',
            '13' => 'Juvenile',
            '15' => 'Library Board',
            '16' => 'Outreach Institutions',
            '17' => 'Staff',
            '18' => 'Teen Courtesy',
            '22' => 'Limited Access Courtesy',
            '23' => 'Teen Paid',
            '27' => 'Teen',
            '31' => 'Limited Access Paid',
            '37' => 'Juvenile Expanded Movie',
            '38' => 'Teen Pass',
            '39' => 'Juvenile Courtesy Expanded Movie',
            '40' => 'Limited Access',
            '41' => 'Teacher',
        ];

        return $patronCodes[$id];
    }
}
