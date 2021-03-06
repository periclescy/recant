<?php
// Get the contents of the JSON file
$data_json = file_get_contents("cfd_data.json");
// Convert to array
$decoded_json = json_decode($data_json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get variables from POST.
    $user = $_POST['user'];
    $classification = $_POST['classification'];
}
else {
    // Set variables - first classification and first user.
    $classification = array_key_first($decoded_json);
    $user = array_key_first($decoded_json[$classification]);
}
$classification_array = $decoded_json[$classification];
$user_array = $classification_array[$user];

// Calculate text on paragraph, for possible outputs.
function classPossibleOutputs($str_value): string
{
    switch ($str_value) {
        case "Gender":
            $return_class = "Male, Female";
            break;
        case "Race":
            $return_class = "Asian, Black, Latino, White";
            break;
        case "Trustworthiness":
        case "Attractiveness":
            $return_class = "Low, Medium, High";
            break;
        default:
            $return_class = "";
    }
    return $return_class;
}

// Calculate cell background and text color based on value.
function classColor($str_value): string
{
    switch ($str_value) {
        case "Female":
            $return_class = "female-style";
            break;
        case "Male":
            $return_class = "male-style";
            break;
        case "Asian":
            $return_class = "asian-style";
            break;
        case "Black":
            $return_class = "black-style";
            break;
        case "Latino":
            $return_class = "latino-style";
            break;
        case "White":
            $return_class = "white-style";
            break;
        case "Low":
            $return_class = "low-style";
            break;
        case "Medium":
            $return_class = "medium-style";
            break;
        case "High":
            $return_class = "high-style";
            break;
        default:
            $return_class = "";
    }
    return $return_class;
}

// Calculate tooltip text based on value
function classModelDescription($str_value): string
{
    switch ($str_value) {
        case "CFD Annotators":
            $return_class = "Model trained on the norming data provided with the CFD.";
            break;
        case "All Annotators":
            $return_class = "Model trained using all the annotations for all images.";
            break;
        case "Men":
            $return_class = "Model trained using all the annotations provided by male crowdworkers.";
            break;
        case "Women":
            $return_class = "Model trained using all the annotations provided by female crowdworkers.";
            break;
        case "Black":
            $return_class = "Model trained using all the annotations provided by Black crowdworkers.";
            break;
        case "Asian":
            $return_class = "Model trained using all the annotations provided by Asian crowdworkers.";
            break;
        case "White":
            $return_class = "Model trained using all the annotations provided by White crowdworkers.";
            break;
        case "Latino":
            $return_class = "Model trained using all the annotations provided by Latino crowdworkers.";
            break;
        case "Random":
            $return_class = "Model that simulates the case where annotators generate labels without considering the image content.";
            break;
        default:
            $return_class = "";
    }
    return $return_class;
}
?>

<?php require 'includes/header.html' ?>

<div class="container-xxl">
    <h1 class="display-4 text-center py-3">RECANT Demonstration Tool</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>1. Input image:</h2>
            <a href="gallery.php"><button id="change-image-button" class="btn btn-md btn-secondary">Click here to change the image</button></a>
            <h6 class="pt-3">Current image: <?php echo $user;?></h6>
            <div class="py-1">&nbsp;</div>
            <div class="text-center">
                <div class="text-center">
                    <img src="img/<?php echo $user;?>.jpg" class="img-fluid mx-auto" alt="user-image" width="500">
                </div>
            </div>
            <div class="display-4 py-3">&nbsp;</div>
        </div>

        <div class="col-md-6">
            <h2>2. Classification task:</h2>
            <blockquote>Select a classification task.</blockquote>
            <div class="row row-cols-2 row-cols-xl-4 g-2">
                <?php foreach($decoded_json as $class_2 => $val_2)  { ?>
                    <?php if($class_2 == $classification)  { ?>
                        <div class="col">
                            <form method='post' action="result.php">
                                <input type='hidden' name='user' value='<?php echo $user;?>' />
                                <input type='hidden' name='classification' value='<?php echo $class_2;?>' />
                                <input class="btn btn-md btn-secondary w-100" type="submit" value='<?php echo $class_2?>' disabled>
                            </form>
                        </div>
                    <?php } else {?>
                        <div class="col">
                            <form method='post' action="result.php">
                                <input type='hidden' name='user' value='<?php echo $user;?>' />
                                <input type='hidden' name='classification' value='<?php echo $class_2;?>' />
                                <input class="btn btn-md btn-outline-secondary w-100" type="submit" value='<?php echo $class_2?>'>
                            </form>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <p class="py-3">The models try to predict the depicted person???s <?php echo $classification;?>.</p>
        </div>
    </div>

    <div class="py-1">&nbsp;</div>

    <h2>3. Results:</h2>
    <blockquote>Click to show Results.</blockquote>
    <button class="btn btn-success" type="button" id="results-button">Execute</button>

    <div class="py-1">&nbsp;</div>
    <div class="d-none text-center pb-5" id="loader-presentation">
        <div class="spinner-border" role="status"></div>
    </div>

    <div class="d-none" id="results-presentation">
        <p class="py-3">Nine different models were trained on the same images for each task, with different (sub)sets of crowd-worker
            annotations. The same input image (above) was passed through each of the nine models, resulting in the
            following outputs (possible outputs: <?php echo classPossibleOutputs($classification); ?>):
        </p>

        <div class="row">
            <div class="col">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>Model</th>
                        <th>Model Description</th>
                        <th>Classification Decision</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    <?php foreach($user_array as $key => $val) { ?>
                        <tr>
                            <td class="w-20 align-middle" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo classModelDescription($key);?>"><?php echo $key;?></td>
                            <td class="w-60 align-middle"><?php echo classModelDescription($key);?></td>
                            <td class="w-20 align-middle <?php echo classColor($val);?>" id="<?php echo $i;?>" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo classModelDescription($key);?>"><?php echo $val;?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center col-md-8 offset-md-2 col-xl-6 offset-xl-3 pt-3 pb-5">
                <a href="https://docs.google.com/forms/d/1LZgdTRrQujHRpDlQPW9tzwcZF3nuVDdsj2vvJcCWXpY" class="btn btn-success w-50 d-none" id="questionnaire-button">Questionnaire</a>
            </div>
        </div>

        </div>
    </div>

<?php require 'includes/footer.html' ?>