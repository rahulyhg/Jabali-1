<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Media
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/media/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' ); ?>
<?php $file = $_GET['src'] ?? "Image";
$file = explode('/', $file );
$file = end( $file ); ?>
<title><?php if ( isset( $_GET['src'] ) ) { echo( ' Viewing ' . ucfirst( $file. ' [ ' ) ); } else {
echo( 'All Media - ' ); } showOption( 'name' ); ?></title>
<div class="mdl-grid ">
	<?php if ( isset( $_GET['src'] ) ) { ?>
		<div class="mdl-cell mdl-cell--8-col mdl-card <?php primaryColor(); ?> mdl-shadow--2dp " >
			<div class="mdl-card__title">
				<div class="mdl-card__title--text">Image
				</div>
				<div class="mdl-layout-spacer"></div>
				<div class="mdl-card__subtitle-text">
					<i class="material-icons">image</i>
				</div>
			</div>
			<div class="mdl-card__media">
				<img src="<?php echo( _UPLOADS.$_GET['src'] ); ?>" width="100%">
			</div>
			<div class="mdl-card__supporting-text mdl-grid">
			</div>
		</div>
		<div class="mdl-cell mdl-cell--4-col mdl-card <?php primaryColor(); ?> mdl-shadow--2dp " >
			<div class="mdl-card__title">
				<div class="mdl-card__title--text">Meta Data
				</div>
				<div class="mdl-layout-spacer"></div>
				<div class="mdl-card__subtitle-text">
					<a href="media?view=all&key=media" class="material-icons">clear</a>
				</div>
			</div>
			<div class="mdl-card__supporting-text mdl-grid">
			</div>
		</div><?php
	} else{
		$path = _ABSUP_;
		if ( is_dir( $path ) ) {
			if ( !isEmptyDir( $path )) {
				$dir = new DirectoryIterator($path);
				foreach ($dir as $fileinfo) {
					if ($fileinfo->isDir() && !$fileinfo->isDot()) {
						$year = $fileinfo->getFilename();
						if( $year !== "temp"){ ?>
							<div class="mdl-cell mdl-cell--12-col mdl-card <?php primaryColor(); ?> mdl-shadow--2dp <?php echo( $year ); ?>" >
								<div class="mdl-card__title">
								<?php $monthy = strtotime( $year.'/1/2');
								$monthy = date( 'o', $monthy); ?>
									<div class="mdl-card__title--text"><?php
										echo $monthy; ?>
									</div>
									<div class="mdl-layout-spacer"></div>
									<div class="mdl-card__subtitle-text">
										<i class="material-icons">date_today</i>
									</div>
								</div>
								<div class="mdl-card__supporting-text mdl-grid">
									<?php $path = _ABSUP_.$year;
									if ( is_dir( $path ) ) {
										if ( !isEmptyDir( $path )) {
											$dir = new DirectoryIterator($path);
											foreach ($dir as $fileinfo) {
												if ($fileinfo->isDir() && !$fileinfo->isDot()) {
													$month = $fileinfo->getFilename(); ?>
													<div class="mdl-cell mdl-cell--12-col <?php echo($month); ?> mdl-card mdl-shadow--2dp <?php primaryColor(); ?>" >
														<div class="mdl-card__title">
														<?php $monthy = strtotime( $year.'/'.$month.'/2');
														$monthy = date( 'F', $monthy); ?>
															<div class="mdl-card__title--text"><?php
																echo $monthy; ?>
															</div>
															<div class="mdl-layout-spacer"></div>
															<div class="mdl-card__subtitle-text">
																<i class="material-icons">today</i>
															</div>
														</div>
														<div class="mdl-card__supporting-text mdl-grid"><?php
														$path = _ABSUP_.$year.'/'.$month;
														if ( is_dir( $path ) ) {
															if ( !isEmptyDir( $path ) ) {
																$dir = new DirectoryIterator($path);
																foreach ($dir as $fileinfo) {
																	if ($fileinfo->isDir() && !$fileinfo->isDot()) {
																		$day = $fileinfo->getFilename(); ?>
																		<div class="mdl-cell mdl-cell--6-col mdl-card <?php primaryColor(); ?> <?php  echo($day);?>" ><div class="mdl-card__title">
																			<?php $monthy = strtotime( $year.'/'.$month.'/'.$day);
																			$monthy = date( 'D, d', $monthy); ?>
																				<div class="mdl-card__title--text"><?php
																					echo $monthy; ?>
																				</div>
																				<div class="mdl-layout-spacer"></div>
																				<div class="mdl-card__subtitle-text">
																					<i class="material-icons">date_today</i>
																				</div>
																			</div>
																			<div class="mdl-card__supporting-text mdl-grid">
																				<?php $path = _ABSUP_.$year.'/'.$month.'/'.$day;
																				if ( is_dir( $path ) ) {
																					if ( !isEmptyDir( $path )) {
																						$dir = new DirectoryIterator($path);
																						foreach ($dir as $fileinfo) {
																							if (!$fileinfo->isDir() && !$fileinfo->isDot()) {
																								$image = $fileinfo->getFilename(); ?>
																								<div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp" >
																									<div class="mdl-card__title">
																										<div class="mdl-card__title-text">
																											<?php echo(ucwords( $image ) ); ?>
																										</div>
																										<div class="mdl-layout-spacer"></div>
																									</div>
																									<div class="mdl-card__media">
																										<img src="<?php echo( _UPLOADS.$year.'/'.$month.'/'.$day.'/'.$image ); ?>" width="100%">
																									</div>
																									<div class="mdl-card__actions">
																										<?php $file = explode('.', $image); $ext = end( $file ); ?>
																										<a class="mdl-button mdl-button--icon material-icons" href="?src=<?php echo( $year.'/'.$month.'/'.$day.'/'.$image ); ?>&type=<?php echo($ext); ?>">open_in_new</a>
																										<div class="mdl-layout-spacer"></div>
																										<a class="mdl-button mdl-button--icon material-icons" href="#">edit</a>
																										<a class="mdl-button mdl-button--icon material-icons" href="#">delete</a>
																									</div>
																								</div><?php 
																							}
																						}
																					}
																				} ?>
																			</div>
																		</div><?php 
																	}
																}
															}
														} ?>
														</div>
													</div><?php 
												}
											}
										}
									} ?>
								</div>
							</div>><?php 
						}
					}
				}
			}
		}
	}
	if ( isCap( 'admin' ) ) {
    newButton('media', 'file', 'file_upload' );
  } ?>
</div><?php
require_once ( './footer.php' );