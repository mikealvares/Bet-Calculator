<?php
/*
Plugin Name: Odds calculator
Description: Odd calculator with option for decimal or fraction odds
Author: Michael Alvares
*/
defined( 'ABSPATH' ) || exit;
function odds_calculator_data(){
    wp_enqueue_script( 'oddsCalculator', plugins_url( 'js/oddsCalculator.js', __FILE__ ), ['jquery'], "", true );
}

function odds_calculator_shortcode() {
	$string = '
		<section class="odds_calc_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p>Enter the Stake and Odds for your bet and the Bet Calculator will automatically calculate the Payout. Add Odds for Multiples.</p>
                        <hr />
                    </div>
                </div><div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end align-self-center form-group row">
                            <label class="label-right col-lg-3 col-md-12 col-sm-12">Selected Odds Format:</label>
                            <div class="col-lg-3 col-md-4 col-sm-2">
                                <select class="oddsFormat form-control">
                                    <option value="2" selected="">Decimal</option>
                                    <option value="3">Fractional</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><div class="row">
                    <div class="col-lg-3 hidden-md-down"></div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="form-group row">
                            <label class="label-center col-lg-12 col-md-6 col-3">Stake</label>
                            <div class="col-lg-12 col-md-6 col-9 center">
                                <input type="text" class="form-control isdec" id="stakeamt" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="form-group row">
                            <label class="label-center col-lg-12 col-md-6 col-12">Odds</label>
                            <div class="col-lg-12 col-md-6 col-10 center">
                                <input type="text" name="odds[]" class="form-control odds isdec" id="oddeamt" onkeyup="calcOdds()" />
                            </div>
                        </div>
                    </div>
                </div><div class="row">
                    <div class="col-lg-3 hidden-md-down"></div>
                    <div class="col-lg-3 col-md-12 col-sm-12"></div>
                    <div class="col-lg-3 col-md-12 col-sm-12" id="newOdds"></div>
                </div><div class="row">
                    <div class="col-lg-3 hidden-md-down"></div>
                    <div class="col-lg-3 hidden-md-down"></div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="form-group row">
                            <label class="label-center col-lg-12 col-md-6 col-3"></label>
                            <div class="col-lg-12 col-md-6 col-9">
                                <span class="add_odds_btn" id="addOdds"><i class="fas fa-plus-circle"></i>&nbsp;Add Odds</span>
                            </div>
                        </div>
                    </div>
                </div><div class="row">
                    <div class="col-lg-3 hidden-md-down"></div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group row">
                            <label class="label-center col-lg-12 col-md-6 col-12">Payout:</label>
                        </div>
                    </div><div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group row">
                            <div id="payout" class="col-lg-12 col-md-6 col-12 payout_total center">&euro; 0.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	';
	return $string;
}

add_shortcode( 'oddsCalc', 'odds_calculator_shortcode' );
add_action( 'init', 'odds_calculator_data' );