<?php
include 'top.php';
?>

<main>
    <h2>WildLife Table</h2>
    <pre>
        CREATE TABLE `tblAdopter` (
        `pmkAdopterEmail` varchar(50) NOT NULL,
        `fldFirstName` varchar(50) NOT NULL,
        `fldLastName` varchar(60) NOT NULL,
        `fldAgreedToTerms` tinyint(1) NOT NULL DEFAULT '1',
        `fldReceiveCommunication` tinyint(1) NOT NULL DEFAULT '1'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        COMMIT;

        ALTER TABLE `tblAdopter`
        ADD PRIMARY KEY (`pmkAdopterEmail`);

        CREATE TABLE `tblAdopterWildlife` (
        `pmkDonationId` int(11) NOT NULL,
        `fpkAdopterEmail` varchar(50) NOT NULL,
        `fpkWildlifeId` int(11) NOT NULL,
        `fldDonationAmount` int(11) NOT NULL DEFAULT '0'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        COMMIT;

        ALTER TABLE `tblAdopterWildlife`
        ADD PRIMARY KEY (`pmkDonationId`);

        ALTER TABLE `tblAdopterWildlife`
        MODIFY `pmkDonationId` int(11) NOT NULL AUTO_INCREMENT;
        COMMIT;

        CREATE TABLE `tblWildlife` (
        `pmkWildlifeId` int(11) NOT NULL,
        `fldType` varchar(12) NOT NULL,
        `fldCommonName` varchar(20) NOT NULL,
        `fldHabitat` text NOT NULL,
        `fldReproduction` text NOT NULL,
        `fldDiet` text NOT NULL,
        `fldStatus` text NOT NULL,
        `fldMainImage` varchar(30) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ALTER TABLE `tblWildlife`
        ADD PRIMARY KEY (`pmkWildlifeId`);

        ALTER TABLE `tblWildlife`
        MODIFY `pmkWildlifeId` int(11) NOT NULL AUTO_INCREMENT;
        COMMIT;
    </pre>

    <p>Select Wildlife</p>
    <pre>
        SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription,
               fldHabitat,  fldReproduction, fldDiet, fldManagement,
               fldStatus, fldMainImage
        FROM tblWildlife
        ORDER BY fldCommonName;
    </pre>

</main>

<?php
include 'footer.php';
?>