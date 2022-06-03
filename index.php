<?php require 'includes/header.html' ?>

    <div class="container">
        <h1 class="display-4 text-center py-3">RECANT Demonstration Tool</h1>
        <div class="row">
            <div class="col-md-6">
                <p class="text-justify">
                    This tool was developed in the framework of the DESCANT:
                    “Detecting Stereotypes in Human Computational Tasks” research project funded by
                    the Research and Innovation Foundation of Cyprus under the RESTART 2016-2020-EXCELLENCE HUBS call.
                    For more information about DESCANT visit the
                    <a href="https://www.cyens.org.cy/en-gb/research/projects/descant-detecting-stereotypes-in-human-computati" target="_blank">project’s website</a>.
                </p>

                <div class="mb-3 ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/hsALsdx82Zo?controls=0" title="YouTube video player" allowfullscreen></iframe>
                </div>

                <h5>What does the tool do?</h5>
                <p class="text-justify">
                    The tool allows users to explore the ways in which the characteristics of the training dataset
                    affect the resulting machine learning models. By selecting an image and classification task,
                    the tool presents the performance results of the machine learning models trained
                    using data annotated by different groups of annotators.
                </p>

            </div>

            <div class="col-md-6">
                <h5>What dataset does the tool use?</h5>
                <p class="text-justify">
                    The <a href="https://www.chicagofaces.org" target="_blank">Chicago Face Database (CFD)</a>
                    was developed at the University of Chicago by Debbie S. Ma, Joshua Correll, and Bernd Wittenbrink.
                    The CFD is intended for use in scientific research. It provides high-resolution,
                    standardized photographs of male and female faces of varying ethnicity between the ages of 17-65.
                    Extensive norming data are available for each individual model.
                    These data include both physical attributes (e.g., face size)
                    as well as subjective ratings by independent judges (e.g., attractiveness).
                    The main CFD set consists of images of 597 unique individuals. They include self-identified
                    Asian, Black, Latino, and White female and male models, recruited in the United States.
                    All models are represented with neutral facial expressions. A subset of the models is also available
                    with happy (open mouth), happy (closed mouth), angry, and fearful expressions.
                    Norming data are available for all neutral expression images.
                    Subjective rating norms are based on a U.S. rater sample.
                </p>

                <h5>What machine learning modeling techniques are used?</h5>
                <p class="text-justify">
                    Model training was done using the lobe.ai tool. By using open-source Machine Learning Architectures,
                    the lobe.ai tool is able to automate Deep Learning classification tasks without the need to perform
                    a rigorous manual model optimisation process, ensuring that all models under comparison are trained
                    using exactly the same training and model optimisation procedures. Furthermore, the lobe.ai tool is
                    able to achieve an excellent performance at low computational costs.
                </p>
            </div>

            <div class="py-3">&nbsp;</div>

            <div class="col text-center">
                <a href="result.php" class="btn btn-primary btn-lg w-50 fs-4">Get Started</a>
            </div>
        </div>
    </div>

    <div class="py-5">&nbsp;</div>

<?php require 'includes/footer.html' ?>