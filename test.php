<?php include 'db_connect.php'?>
<?php
//$cnn = getConnect();
//$query = "SELECT * FROM users ORDER BY userID";
//$result=$cnn->query($query);
//$result->data_seek(2);
//$row=$result->fetch_row();
//echo ($row[1])."   ".($row[2]).'//';
//$result->data_seek(0);
//$row=$result->fetch_row();
//echo ($row[1])."   ".($row[2].'//');
//$row=$result->fetch_assoc();
//echo ($row['name'])."   ".($row['password']);
//$row=$result->fetch_assoc();
//echo ($row[1])."   ".($row[2]);
$str = "The terracotta shades and heavy monumentality of the figures in <em>Two Nudes</em> derive from Picasso's interest at the time in the ancient Iberian sculpture of his native Spain. Like many artists in the first decades of the twentieth century, Picasso found ancient and non-western art to be fruitful alternatives both to the prescribed forms of academic painting and the visual culture of industrial modernity. These two women are nearly mirror images, but the face of the figure on the left bears a strong resemblance to that of the figure on the far left in <em>Les Demoiselles d'Avignon</em>. Like the woman in Demoiselles, with whom she shares her chiseled nose and dark, hollow eyes, this woman holds open what appears to be a curtain and gazes outward, as though beckoning viewers in.";
echo strpos($str,"</em>",0)."   ".strpos($str,"<em>",0);
?>