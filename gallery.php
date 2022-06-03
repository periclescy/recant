<?php
// Get the contents of the JSON file.
$data_json = file_get_contents("cfd_data.json");
// Convert to array
$decoded_json = json_decode($data_json, true);

// Get the first classification name.
$firstKey = array_key_first($decoded_json);

// Get first classification's array.
$array_firstKey = $decoded_json[$firstKey];

?>

<?php require 'includes/header.html' ?>

<div class="container-fluid p-3">
    <h2>1. Input image:</h2>
    <blockquote>Please select an image from below.</blockquote>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 g-1 text-center">
        <?php foreach($array_firstKey as $key => $val)  { ?>
			<div class="col">
				<div class="card">
					<div class="card-body">
                        <form method='post' action="result.php">
                            <input type='hidden' name='user' value='<?php echo $key;?>' />
                            <input type='hidden' name='classification' value='<?php echo $firstKey;?>' />
                            <button class="btn hover-effect" type="submit">
                                <img src="img/<?php echo $key;?>_thumb.jpg" class="card-img-top" alt="<?php echo $key;?>">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="py-5">&nbsp;</div>

<?php require 'includes/footer.html' ?>