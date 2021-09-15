<!--Lee Kapp - CS148 Final - data dictionary-->

<?php
include 'top.php';
?>

<main>
    <h2>Data Dictionary for the Laboratory Inventory Database</h2>
<section>
        <table id="datadict">
            <tr>
                <th>Table</th>
                <th>Field</th>
                <th>Description</th>
                <th>Type</th>
                <th>Size</th>
                <th>Values</th>
                <th>Example</th>
            </tr>
            <tr>
                <td>tblCategory</td>
                <td>pmkCategoryName</td>
                <td>Primary Key</td>
                <td>VARCHAR</td>
                <td>70</td>
                <td></td>
                <td>Consumables</td>
            </tr>
            <tr>
                <td></td>
                <td>fldCategoryImage</td>
                <td>Representative picture of category</td>
                <td>VARCHAR</td>
                <td>70</td>
                <td></td>
                <td>consumables.jpg</td>
            </tr>
            <tr>
                <td>tblPersonnel</td>
                <td>pmkEmployeeEmail</td>
                <td>Primary Key</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>ffredson@uvm.edu</td>
            </tr>
            <tr>
                <td></td>
                <td>fldEmployeeFname</td>
                <td>Employee First Name</td>
                <td>VARCHAR</td>
                <td>50</td>
                <td></td>
                <td>Fred</td>
            </tr>
            <tr>
                <td></td>>
                <td>fldEmployeeLname</td>
                <td>Employee Last Name</td>
                <td>VARCHAR</td>
                <td>50</td>
                <td></td>
                <td>Fredson</td>
            </tr>
            <tr>
                <td></td>
                <td>fldJobTitle</td>
                <td>Job description of person placing the order</td>
                <td>TEXT</td>
                <td>50</td>
                <td>principle_investigator, technician, graduate_student, post_doc, researcher, administrator</td>
                <td></td>
            </tr>
            <tr></tr>
            <tr>
                <td>tblProject</td>
                <td>pmkProjectName</td>
                <td>Primary Key</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>Brambleberry</td>
            </tr>
            <tr>
                <td></td>
                <td>fldFundingSource</td>
                <td>The grant to debit for the item</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>NIGMS:1234</td>
            </tr>
            <tr></tr>
            <tr>
                <td>tblOrders</td>
                <td>pmkOrderNumber</td>
                <td>Primary Key (Auto Increment)</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>ffredson@uvm.edu</td>
            </tr>
            <tr>
                <td></td>
                <td>fnkEmployeeEmail</td>
                <td>References pmkEmployeeEmail in tblPersonnel</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>ffredson@uvm.edu</td>
            </tr>
            <tr>
                <td></td>
                <td>fldOrderDate</td>
                <td>The date the order was placed</td>
                <td>DATE</td>
                <td></td>
                <td></td>
                <td>YYYY-MM-DD</td>
            </tr>
            <tr>
                <td></td>
                <td>fnkItemNumber</td>
                <td>References pmkItemNumber in tblItems</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>A-123456</td>
            </tr>
            <tr>
                <td></td>
                <td>fnkItemName</td>
                <td>References fldItemName in tblItems</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>pipette tips</td>
            </tr>
            <tr>
                <td></td>
                <td>fnkProjectName</td>
                <td>References fldProjectName from tblProject</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>Ints6</td>
            </tr>
            <tr>
                <td></td>
                <td>fldQuantity</td>
                <td>The number of this item ordered</td>
                <td>INT</td>
                <td>11</td>
                <td></td>
                <td>5</td>
            </tr>
            <tr>
                <td></td>
                <td>fnkCost</td>
                <td>The cost of the item</td>
                <td>DOUBLE</td>
                <td>5,2</td>
                <td></td>
                <td>125.00</td>
            </tr>
            <tr>
                <td></td>
                <td>fnkVendorName</td>
                <td>The vendor's name</td>
                <td>VARCHAR</td>
                <td>200</td>
                <td></td>
                <td>Invitrogen</td>
            </tr>
            <tr></tr>
            <tr>
                <td>tblItems</td>
                <td>pmkItemNumber</td>
                <td>The vendor's product number for the item</td>
                <td>VARCHAR</td>
                <td>50</td>
                <td></td>
                <td>P02-681-02</td>
            </tr>
            <tr>
                <td></td>
                <td>fldItemName</td>
                <td>The vendor's name for the item</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>Easyload Tips</td>
            </tr>
            <tr>
                <td></td>
                <td>fldCost</td>
                <td>The vendor's price for the item</td>
                <td>DOUBLE</td>
                <td>5,2</td>
                <td></td>
                <td>125.67</td>
            </tr>
            <tr>
                <td></td>
                <td>fldDescription</td>
                <td>The item's description</td>
                <td>TEXT</td>
                <td>400</td>
                <td></td>
                <td>P200 pipette tips - bag/500</td>
            </tr>
            <tr>
                <td></td>
                <td>fldVendorName</td>
                <td></td>
                <td>TEXT</td>
                <td>200</td>
                <td></td>
                <td>Fisher Scientific</td>
            </tr>
            <tr>
                <td></td>
                <td>fldVendorContact</td>
                <td>Vendor or sales rep address, phone number, email, or website</td>
                <td>TEXT</td>
                <td>400</td>
                <td></td>
                <td>orders@fishersci.com</td>
            </tr>
            <tr>
                <td></td>
                <td>fldCategory</td>
                <td>What type of item is this?</td>
                <td>ENUM</td>
                <td></td>
                <td>consumables, equipment, glassware, chemicals, molecular_biology, office_supplies</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>fldItemImage</td>
                <td>An image of the item</td>
                <td>VARCHAR</td>
                <td>100</td>
                <td></td>
                <td>pipettes.jpg</td>
            </tr>
        </table>
</section>
</main>

<?php
include 'footer.php';
?>