<!--Lee Kapp - CS148 Final - index.php-->
<?php
include 'top.php';

$sql =  'SELECT pmkCategoryName, fldCategoryImage FROM tblCategory';

$data = '';
$items = $thisDatabaseReader->select($sql, $data);

?>

<main>
    <h2>Order Laboratory Items by Category</h2>
    <section id="indexpage">
        <p>
            <ul>
            <li><em>Consumables</em> consist of disposable items like pipette tips, microcentrifuge
                tubes, conical tubes, culture tubes and plates.</li>
            <li><em>Molecular biology</em> reagents include items like cloning kits, restriction enzymes, dNTPs, polymerases,
                and associated buffers.</li>
            <li><em>Office supplies</em> consist of notebooks, pens, paper, rulers, folders, etc</li>
            <li><em>Glassware</em> includes all beakers, flasks, graudated cylinders (even if plastic), glass plates, and the like</li>
            <li><em>Chemicals</em> include salts, detergents, alcohols, organics, and growth media.</li>
            <li><em>Equipment</em> includes all electronic or mechanical items like pipettors, shakers, stir plates, etc.</li>
            </ul>

<?php
if(is_array($items)) {
    foreach($items as $item) {
        print('<figure class="indexitem">');
        print('<a href="displayItems.php?category=' . $item['pmkCategoryName'] . '">'
            . '<img alt="' . $item['pmkCategoryName'] . '" src = "images/' . $item['fldCategoryImage'] . '"></a>');
        print('<figcaption>' . '<strong>' . $item['pmkCategoryName'] . '</strong>' . '</figcaption>');
        print('</figure>');
    }
}
print '</section>';
print '</main>';

include 'footer.php';

?>