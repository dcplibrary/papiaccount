<?php

namespace Dcplibrary\PAPIAccount\App\Concerns;

trait PatronAccountConcerns
{
    private function authenticate()
    {
        $json = [
            'Barcode'  => $this->form->Barcode,
            'Password' => $this->form->Password,
        ];

        $response = $this->papiclient
            ->method('post')
            ->uri('authenticator/patron')
            ->params($json)->execRequest();

        $this->form->AccessSecret = $response['AccessSecret'];

        return true;
    }

    private function getPatronBasicData()
    {
        $response = $this->papiclient
            ->method('get')
            ->patron($this->form->Barcode)
            ->auth($this->form->AccessSecret)
            ->uri('/basicdata?addresses=true&notes=true')
            ->execRequest();

        return $response['PatronBasicData'];
    }

    public function setPatronData($patronData): void
    {
        $this->form->PatronID = $patronData['PatronID'];
        $this->form->Barcode = $patronData['Barcode'];
        $this->form->NameFirst = $patronData['NameFirst'];
        $this->form->NameLast = $patronData['NameLast'];
        $this->form->NameMiddle = $patronData['NameMiddle'];
        $this->form->PhoneVoice1 = $patronData['PhoneNumber'];
        $this->form->EmailAddress = $patronData['EmailAddress'];
        $this->form->NameSuffix = $patronData['NameSuffix'];
        $this->form->Phone1CarrierID = $patronData['Phone1CarrierID'];
        $this->form->CellPhone = $patronData['CellPhone'];
        $this->form->CellPhoneCarrierID = $patronData['CellPhoneCarrierID'];
        $this->form->BirthDate = $this->formatToDateString($patronData['BirthDate']);
        $this->form->displayableBirthDate = $this->displayableDate($this->form->BirthDate);

        $this->form->RegistrationDate = $this->formatToDateString($patronData['RegistrationDate']);
        $this->form->displayableRegistrationDate = $this->displayableDate($this->form->RegistrationDate);
        $this->form->LastActivityDate = $this->formatToDateString($patronData['LastActivityDate']);
        $this->form->displayableLastActivityDate = $this->displayableDate($this->form->LastActivityDate);
        $this->form->AddrCheckDate = $this->formatToDateString($patronData['AddrCheckDate']);
        $this->form->displayableAddrCheckDate = $this->displayableDate($this->form->AddrCheckDate);
        $this->form->PatronCodeID = $patronData['PatronCodeID'];
        $this->form->patronCode = $this->form->getPatronCode($this->form->PatronCodeID);
        $this->form->DeliveryOptionID = $patronData['DeliveryOptionID'];
        $this->form->TxtPhoneNumber = $patronData['TxtPhoneNumber'];
        $this->form->ExpirationDate = $this->formatToDateString($patronData['ExpirationDate']);
        $this->form->displayableExpirationDate = $this->displayableDate($this->form->ExpirationDate);

        $this->form->User1 = $patronData['User1'];
        $this->form->User2 = $patronData['User2'];
        $this->form->User3 = $patronData['User3'];
        $this->form->User4 = $patronData['User4'];
        $this->form->User5 = $patronData['User5'];
        $this->form->FormerID = $patronData['FormerID'];
        $this->setPatronAddress($patronData['PatronAddresses'][0]);
        $this->setPatronNotes($patronData['PatronNotes']);
    }

    public function setPatronAddress($patronAddress): void
    {
        $this->form->AddressID = $patronAddress['AddressID'];
        $this->form->StreetOne = $patronAddress['StreetOne'];
        $this->form->StreetTwo = $patronAddress['StreetTwo'];
        $this->form->City = $patronAddress['City'];
        $this->form->County = $patronAddress['County'];
        $this->form->State = $patronAddress['State'];
        $this->form->PostalCode = $patronAddress['PostalCode'];
        $this->form->Country = $patronAddress['Country'];
    }

    public function setPatronNotes($patronNotes): void
    {
        $this->form->NonBlockingBranchID = $patronNotes['NonBlockingBranchID'];
        $this->form->NonBlockOrgName = $patronNotes['NonBlockOrgName'];
        $this->form->NonBlockingUserID = $patronNotes['NonBlockingUserID'];
        $this->form->NonBlockUsrName = $patronNotes['NonBlockUsrName'];
        $this->form->NonBlockingWorkstationID = $patronNotes['NonBlockingWorkstationID'];
        $this->form->DisplayName = $patronNotes['DisplayName'];
        $this->form->BlockingBranchID = $patronNotes['BlockingBranchID'];
        $this->form->BlockingOrgName = $patronNotes['BlockingOrgName'];
        $this->form->BlockingUserID = $patronNotes['BlockingUserID'];
        $this->form->BlockingUsrName = $patronNotes['BlockingUsrName'];
        $this->form->BlockingWorkstationID = $patronNotes['BlockingWorkstationID'];
        $this->form->BlockingWorkstationDisplayName = $patronNotes['BlockingWorkstationDisplayName'];
        $this->form->NonBlockingStatusNotes = $patronNotes['NonBlockingStatusNotes'];
        $this->form->NonBlockingStatusNoteDate = $patronNotes['NonBlockingStatusNoteDate'];
        $this->form->BlockingStatusNotes = $patronNotes['BlockingStatusNotes'];
        $this->form->BlockingStatusNoteDate = $patronNotes['BlockingStatusNoteDate'];
    }
}
