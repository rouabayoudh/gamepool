<?php include('includes/header.php'); ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card" style="width: 900px; height: 600px;">
            <div class="card-header">
                <h4>
                    Feedbacks List
                </h4>
            </div>
            <div class="card-body">
                <?= Functions::alertMessage(); ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $feedbacks = Functions::getall('users'); // Retrieve feedbacks data using getall() function

                            $complaints = array();
                            $suggestions = array();

                            if (!empty($feedbacks)) {
                                foreach ($feedbacks as $feedbackItem) {
                                    if ($feedbackItem['type'] == 1) {
                                        $complaints[] = $feedbackItem;
                                    } else {
                                        $suggestions[] = $feedbackItem;
                                    }
                                }

                                // Sort complaints and suggestions
                                usort($complaints, function($a, $b) {
                                    return $b['type'] - $a['type'];
                                });

                                usort($suggestions, function($a, $b) {
                                    return $b['type'] - $a['type'];
                                });

                                // Display complaints first, then suggestions
                                $sortedFeedbacks = array_merge($complaints, $suggestions);

                                foreach ($sortedFeedbacks as $feedbackItem) {
                            ?>
                                    <tr>
                                        <td><?= $feedbackItem['email']; ?></td>
                                        <td><?= $feedbackItem['type'] == 1 ? 'Complaint' : 'Suggestion'; ?></td>
                                        <td><?= $feedbackItem['message']; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="3">No Feedbacks Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

