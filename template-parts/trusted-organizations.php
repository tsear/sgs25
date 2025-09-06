<?php
/**
 * Trusted Organizations Carousel Section
 * 
 * Displays logos of organizations that trust Smart Grant Solutions
 * Recreates Tilda t738 carousel component exactly
 */
?>

<section class="trusted-organizations-section">
    
    <div class="trusted-orgs-container">
        
        <!-- Section Title -->
        <div class="trusted-orgs-title">
            <h2>
                TRUSTED BY ORGANIZATIONS MANAGING GRANTS FROM TOP U.S. FUNDERS
            </h2>
        </div>
        
        <!-- Carousel Container -->
        <div class="trusted-orgs-carousel" data-carousel="trusted-orgs">
            
            <!-- Navigation Arrows -->
            <div class="carousel-navigation">
                <button type="button" class="carousel-arrow carousel-arrow--left" aria-label="Previous slide" data-direction="prev">
                    <svg width="7" height="13" viewBox="0 0 7.3 13" xmlns="http://www.w3.org/2000/svg">
                        <polyline fill="none" stroke="#222" stroke-linejoin="butt" stroke-linecap="butt" stroke-width="1" points="0.5,0.5 6.5,6.5 0.5,12.5"/>
                    </svg>
                </button>
                
                <button type="button" class="carousel-arrow carousel-arrow--right" aria-label="Next slide" data-direction="next">
                    <svg width="7" height="13" viewBox="0 0 7.3 13" xmlns="http://www.w3.org/2000/svg">
                        <polyline fill="none" stroke="#222" stroke-linejoin="butt" stroke-linecap="butt" stroke-width="1" points="0.5,0.5 6.5,6.5 0.5,12.5"/>
                    </svg>
                </button>
            </div>
            
            <!-- Slides Container -->
            <div class="carousel-slides-wrapper">
                <div class="carousel-slides" data-slides-container>
                    
                    <!-- Slide 1 -->
                    <div class="carousel-slide carousel-slide--active" data-slide="1">
                        <div class="trusted-orgs-grid">
                            
                            <div class="trusted-org-item">
                                <a href="https://www.pa.gov/agencies/dep.html" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6636-6266-4766-b763-623938663761__1_1.png" 
                                         alt="Pennsylvania Department of Environmental Protection" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="https://hillmanfamilyfoundations.org/" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3161-3234-4331-a238-363831613162__2_3.png" 
                                         alt="Hillman Family Foundations" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="https://ovc.ojp.gov/" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6635-6566-4033-b633-313166663836__3_2.png" 
                                         alt="Office for Victims of Crime" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="https://www.bnymellon.com/" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3037-6434-4966-a434-633537623633__4_2.png" 
                                         alt="BNY Mellon" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="https://yieldgiving.com/" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6533-6661-4133-b634-616232383039__5_2.png" 
                                         alt="Yield Giving" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="https://www.heinz.org/" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6563-3965-4264-b363-633532396561__6_1.png" 
                                         alt="Heinz Endowments" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="carousel-slide" data-slide="2">
                        <div class="trusted-orgs-grid">
                            
                            <div class="trusted-org-item">
                                <a href="https://www.eda.gov/" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3863-3637-4163-b833-366165323038__7_3.png" 
                                         alt="Economic Development Administration" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="https://www.defense.gov/News/Tag/134382/office-of-economic-adjustment/" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6130-3664-4637-b331-643632353632__8_5.png" 
                                         alt="Office of Economic Adjustment" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="https://www.pa.gov/agencies/pccd.html" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3139-3661-4164-a261-303230366464__9_2.png" 
                                         alt="Pennsylvania Commission on Crime and Delinquency" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3561-3663-4337-b535-393030316265__10_2.png" 
                                         alt="Government Organization" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3834-3233-4561-a463-363032343365__11_2.png" 
                                         alt="Government Organization" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                            <div class="trusted-org-item">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6462-3432-4132-b333-616533353165__12_2.png" 
                                         alt="Government Organization" 
                                         class="trusted-org-logo" />
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        
    </div>
    
</section>
