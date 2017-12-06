<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Admin Dashboard
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/dashboard/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( '../load.php' );
require_once( 'header.php' ); ?>
<title>Dashboard - <?php showOption( 'name' ); ?></title>
  <div class="mdl-grid mdl-grid--no-spacing">

            <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-cell--top">
                <!-- Quick Links-->
                <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
                    <div class="mdl-card mdl-shadow--2dp trending <?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Quick Links</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <ul class="mdl-list">
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content list__item-text">Add new user</span>
                                    <span class="mdl-list__item-secondary-content">
                                        <i class="mdi mdi-account"></i>
                                    </span>
                                </li>
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content list__item-text">Add new user</span>
                                    <span class="mdl-list__item-secondary-content">
                                        <i class="mdi mdi-account"></i>
                                    </span>
                                </li>
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content list__item-text">Add new user</span>
                                    <span class="mdl-list__item-secondary-content">
                                        <i class="mdi mdi-account"></i>
                                    </span>
                                </li>
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content list__item-text">Add new user</span>
                                    <span class="mdl-list__item-secondary-content">
                                        <i class="mdi mdi-account"></i>
                                    </span>
                                </li>
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content list__item-text">Add new user</span>
                                    <span class="mdl-list__item-secondary-content">
                                        <i class="mdi mdi-account"></i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Pie chart-->
                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                    <div class="mdl-card mdl-shadow--2dp pie-chart <?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Post Content</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <div class="pie-chart__container">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Trending widget-->
                <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--2-col-phone">
                    <div class="mdl-card mdl-shadow--2dp trending <?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Trending Blogs</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <ul class="mdl-list">
                                <?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content list__item-text"><?php theTitle(); ?></span>
                                    <span class="mdl-list__item-secondary-content">
                                        <?php theAuthor(); ?>
                                    </span>
                                </li>
                            <?php endwhile; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Line chart-->
                <div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--4-col-phone">
                    <div class="mdl-card mdl-shadow--2dp line-chart <?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Statistics</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <div class="line-chart__container">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ToDo_widget-->
                <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--2-col-phone">
                    <form class="mdl-card mdl-shadow--2dp todo <?php primaryColor(); ?>" action="" method="POST" >
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">To-do list</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <ul class="mdl-list">

                            </ul>
                        </div>
                        <?php csrf(); ?>
                        <div class="mdl-card__actions">
                            <button type="reset" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"><i class="material-icons">delete</i></button>
                            <button type="submit" name="save-to-do" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"><i class="material-icons">save</i></button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-shadow--8dp mdl-button--colored ">
                                <i class="material-icons mdl-js-ripple-effect">add</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            

  </div><?php
include './footer.php'; ?>
    <script type="text/javascript">
        'use strict';

        {
          var colors = ['rgba(96, 196, 150, 1)', 'rgba(80, 150, 215, 1)', 'rgba(0, 188, 212, 1)', 'rgba(116, 199, 209, 1)', 'rgba(255, 82, 82, 1)', 'rgba(0, 0, 0, 0)'];

          var data = [{
            'key': 'Articles',
            'y': 0,
            'end': 9
          }, {
            'key': 'Pages',
            'y': 0,
            'end': 3
          }, {
            'key': 'Projects',
            'y': 0,
            'end': 8
          }, {
            'key': 'Pending',
            'y': 23.9
          }];

          nv.addGraph(function () {
            var innerRadius = 0.86,
                outerRadius = 1.02;

            var pieChart = nv.models.pieChart().x(function (d) {
              return d.key;
            }).y(function (d) {
              return d.y;
            }).showLabels(false).donut(true).growOnHover(true).padAngle(.04).cornerRadius(0).margin({ 'left': -10, 'right': -10, 'top': -10, 'bottom': -10 }).color(colors).arcsRadius([{ 'inner': innerRadius, 'outer': outerRadius }, { 'inner': innerRadius, 'outer': outerRadius }, { 'inner': innerRadius, 'outer': outerRadius }, { 'inner': innerRadius, 'outer': outerRadius }, { 'inner': innerRadius, 'outer': outerRadius }]).showLegend(false).title('0 posts').titleOffset(10);

            pieChart.tooltip.enabled(true).hideDelay(0).headerEnabled(false).contentGenerator(function (d) {
              if (d === null) {
                return '';
              }
              d3.selectAll('.nvtooltip').classed('mdl-tooltip', true);
              return d.data.y + ' published';
            });

            var container = d3.select('.pie-chart__container').append('div').append('svg').datum(data).transition().duration(1200).call(pieChart);

            var h = 0,
                i = 0;
            var timer = setInterval(animatePie, 70, data);

            function animatePie(data) {
              if (i < data.length - 1) {
                if (data[i].y < data[i].end) {
                  data[i].y++;
                  data[data.length - 1].y--;
                  pieChart.title(<?php resetLoop(); echo( count( $GLOBALS['grecords'] ) ); ?> + ' posts');
                  h++;
                } else {
                  i++;
                }
              } else {
                data.splice(data.length - 1, 1);
                clearInterval(timer);
                return;
              }
              if (container[0][0]) {
                pieChart.update();
              } else {
                clearInterval(timer);
              }
            }

            d3.select('.nv-pie .nv-pie').append('i').attr('class', 'mdi mdi-account mdi-48px text--white').attr('transform', 'translate(-15,-35)');

            var color = d3.scale.ordinal().range(colors);

            var legend = d3.select('.pie-chart__container').append('div').attr('class', 'legend').selectAll('.legend__item').data(data.slice(0, data.length - 1)).enter().append('div').attr('class', 'legend__item');

            legend.append('div').attr('class', 'legend__mark pull-left').style('background-color', function (d) {
              return color(d.key);
            });

            legend.append('div').attr('class', 'legend__text').text(function (d) {
              return d.key;
            });

            return pieChart;
          });
        }
    </script>