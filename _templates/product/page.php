<?php
$pid = $_GET['pid'];
if ($_GET['pid']) { ?>
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="tabs-custom row row-50 justify-content-center flex-lg-row-reverse text-center text-md-left" id="tabs-4">
                <div class="col-lg-4 col-xl-3">
                    <h5 class="text-spacing-200 text-capitalize">More about the book</h5>
                    <ul class="nav list-category list-category-down-md-inline-block">
                        <li class="list-category-item wow fadeInRight" role="presentation" data-wow-delay="0s"><a class="active" href="#tabs-4-1" data-toggle="tab">Description</a></li>
                        <li class="list-category-item wow fadeInRight" role="presentation" data-wow-delay=".1s"><a href="#tabs-4-2" data-toggle="tab">Author</a></li>
                        <li class="list-category-item wow fadeInRight" role="presentation" data-wow-delay=".2s"><a href="#tabs-4-3" data-toggle="tab">Book detail</a></li>
                        <p>&nbsp;</p>
                        <li><span style="font-size:14px;">PRICE : &#8377;
                                <?php
                                $book = new stock($pid);
                                echo $book->getprice('pid', $pid); ?></span></li>
                    </ul><a class="button button-xl button-primary button-winona" href="cart.php?pid=<?php print($pid);?>&item=1">Add to cart</a>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <!-- Tab panes-->
                    <div class="tab-content tab-content-1">
                        <div class="tab-pane fade show active" id="tabs-4-1">
                            <h4><?php
                                print($book->getbookname('pid', $pid));
                                ?></h4>

                            <p><?php
                                print($book->getdescription('pid', $pid));
                                ?></p>
                            <p style="text-align:right"><em><?php echo "-" . $book->getauthor('pid', $pid); ?></em></p>
                            <?php
                            print($book->getimage(250, 250));
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tabs-4-2">
                            <h4><?php
                                print($book->getauthor('pid', $pid));
                                ?></h4>
                            <p><?php
                                print($book->getaboutauthor('pid', $pid)); ?></p>
                        </div>
                        <div class="tab-pane fade" id="tabs-4-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Book-id</td>
                                        <td><?php echo $pid; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Author</td>
                                        <td><?php echo ucfirst($book->getauthor('pid', $pid)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td><?php print(ucfirst($book->gettype('pid', $pid))); ?></td>
                                    </tr>
                                    <tr>
                                        <td>publiser</td>
                                        <td><?php print(ucfirst($book->getpubliser('pid', $pid))); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date-of-Publish</td>
                                        <td><?php print($book->getdop('pid', $pid)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>language</td>
                                        <td><?php print(ucfirst($book->getlanguage('pid', $pid))); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
    sessions::load_script('index');
}
?>