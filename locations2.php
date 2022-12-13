<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Locations</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class="content"><!--body content holder-->
            <div class="container">
                <div class="col-md-12"><!--body content title holder with 12 grid columns-->
                    <h1>Our Venues</h1><!--body content title-->
                </div>
            </div>
			
            <div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
			
            <div class="row"><!--location content -->
                <section>
                    <div class="container">
                        <div class="col-md-4"><!--image holder with 4 grid column-->
                            <img src="images/urbanxchange.jpg" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-8"><!--location non modal content -->
                            <h1 class="title">UrbanXchange Private Dining Room</h1><!--location title-->
                            <p class="location"><!--location secondary content-->
                                The Rocks 12 Argyle Street
                            </p>
                            <p class="definition"><!--content body-->
                                Sitting amongst historic sandstone, the Urban Xchange Private Dining
                                Room is the epitome of elegance for a sophisticated celebration.When you dine in the 
                                UrbanXchange Private Dining Room, you can choose from our award winning Saké Restaurant
                                & Bar menu served banquet style, or an elegant menu from The Cut Bar & Grill.
                            </p>
                        </div><!--subcontent div-->
                    </div><!--container div-->
                </section>
            </div><!--row div-->
        </div>
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
