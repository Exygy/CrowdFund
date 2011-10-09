<?php

/**
 * Project:     Php5tube: A PHP class for using the Youtube API<br />
 * File:        Php5tube.php<br />
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or any later version.<br /><br />
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.<br /><br />
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA<br /><br />
 *
 * Any modifications to the library should be indicated clearly in the source code
 * to inform users that the changes are not a part of the original software.<br /><br />
 *
 * @link http://www.debuggeddesigns.com/open-source-projects/php5tube Php5tube Youtube API Wrapper
 * @link http://sourceforge.net/projects/php5tube/ Download Latest Version
 * @link http://www.debuggeddesigns.com/open-source-projects/php5tube/docs Online Documentation
 * @copyright 2008 Debugged Interactive Designs
 * @author debuggeddesigns <info@debuggeddesigns.com>
 * @version 0.0.3 (October 07, 2008)
 *
 */
 
 
/**
  ChangeLog
  
  0.3
  - Added ability to get a list of the most viewed videos on youtube [getMostViewed()]

  0.2
  - Added ability to get a video's information, given the video's youtube id [getVideoInfo()]
  - Added ability to get a video's comments, given the video's youtube id [getVideoComments()]

  0.1
  - Added ability to get a user's information, given the user's account name [getUserInfo()]
  - Added ability to get a user's videos, give the user's account name [getUserVideos()]

*/
 
 
/**
 * Php5tube Class.
 * 
 * Php5tube is a class written by Debugged Interactive Designs in PHP5 
 * to act as a wrapper for Youtube's API. 
 * 
 * Methods process the response XML and return a friendly array of data 
 * to make development simple and intuitive.
 *
 */
 
class Php5tubeComponent extends Object {

	/*
	 * Current Working functions
	 * 
	 * getVideoInfo()
	 * getUserVideos()
	 * getUserInfo()
	 * getMostViewed()
	 * getVideoComments()
	 * 
	 * Functions Under Production
	 * 
	 * getVideosByKeywords($start,$max,$order)
	 * getVideosByCategory($start,$max,$order) 
	 * 
	 * 
	 */
	 
	 
//CLASS VARIABLES

	/**
	 * The video object name in the returned array
	 *
	 * @var string
	 */
	var $video_object = null;
	 
	/**
	 * The user object name in the returned array
	 *
	 * @var string
	 */
	var $user_object = null;
	 
	/**
	 * The comment object name in the returned array
	 *
	 * @var string
	 */
	var $comment_object = null;
	
	/**
	 * Set to the next index in the query 
	 * or -1, if there are no more videos left
	 * 
	 * @var int
	 */
	var $next_index = -1;



//CLASS CONSTRUCTOR

	/**
	 * Class constructor.
	 * 
	 * <code>
	 *   <?php
	 *   include 'Php5tube.php';
	 *   $php5tube = new Php5tube('Video','User','Comment');
	 *   ?>
	 * </code>
	 * 
	 * @param string $video The video object name in the returned array.
	 * @param string $user The user object name in the returned array
	 * @param string $comment The comment object name in the returned array
	 */
	function Php5tube($video, $user, $comment) {
		$this->video_object = $video;
		$this->user_object = $user;
		$this->comment_object = $comment;
	}
	
	
//CLASS FUNCTIONS
	
	/**
	 * Returns all youtube videos that belong to the corresponding user.
	 * 
	 * <code>
	 *   <?php
	 *   include 'Php5tube.php';
	 *   $php5tube = new Php5tube('Video','User','Comment');
	 *   $user_vids = $php5tube->getUserVideos('rickrolled','',1,10);
	 *   ?>
	 * </code>
	 * 
	 * @param string $user The account name of the youtube user.
	 * @param string $category The category to search.
	 * @param integer $start_index The first video id you want to grab. The default is 1.
	 * @param integer $max The maximum number of videos returned.
	 * 
	 * @return array array[<numbered_index>][$this->video_object][<field_name>] where <field_name> =<br />
	 * {'youtube_id', 'author', 'title', 'description', 'keywords', 'url', 'thumbnail1', 'thumbnail2', 'thumbnail3', 'thumbnail4', 'length', 'view_count', 'favorite_count', 'comments_count'}
	 */
	 
	function getUserVideos($user,$category=null,$start_index =1,$max = 25){
		//set up the url to the feed
		$feedURL = 'http://gdata.youtube.com/feeds/api/videos?author='.$user.'&start-index='.$start_index.'&max-results='.$max;
		
		//add category variable to feed url, if it exists
		if($category != null){ $feedURL = $feedURL . '&category=' . $category; }
		
		//read the feed and place it in an simple_xml object
		$xml = @simplexml_load_file($feedURL);
		
		//get the next start index.
		if(!empty($xml->link[4])){
			$this->next_index = (int)preg_replace('/&max-results='.$max.'/', '', preg_replace('/http:\/\/gdata.youtube.com\/feeds\/api\/videos\?author='.$user.'&start-index=/','', (string)$xml->link[4]->attributes()->href));
		} //if empty, then set $this->nex_index to -1 to let the user know they have reached the end of the list
		else {
			$this->next_index = -1;
		}
		
		$video_array = array (); //holds the video objects
		$i = 0;
		foreach ($xml->entry as $entry) {
			//id is the full url to get the video feed.  the characters after the last slash is the actual video id
			//so id here could be 'http://gdata.youtube.com/feeds/api/videos/2jkExrrm_sQ'  with the actual video id being 2jkExrrm_sQ
			$c = array(); //reset memory for temp video object
			//extract youtube id from url
			$c[$this->video_object]['youtube_id'] = preg_replace('/http:\/\/gdata.youtube.com\/feeds\/api\/videos\//','',(string) $entry->id);
			$c[$this->video_object]['author'] = $entry->author->name;
			
			$video = array(); //reset variable
			//magically gets new variables for each video
			$video = $entry->children('http://search.yahoo.com/mrss/');
			$player = $video->group->player->attributes(); //get value for player variable
			$thumbnail1 = $video->group->thumbnail[0]->attributes(); //get value for first thumbnail variable
			$thumbnail2 = $video->group->thumbnail[1]->attributes(); //get value for first thumbnail variable
			$thumbnail3 = $video->group->thumbnail[2]->attributes(); //get value for first thumbnail variable
			$thumbnail4 = $video->group->thumbnail[3]->attributes(); //get value for first thumbnail variable
			
			$c[$this->video_object]['title'] = (string) $video->group->title;
			$c[$this->video_object]['description'] = (string) $video->group->description;
			//keywords are a number of keywords in one string separated by commas
			$c[$this->video_object]['keywords'] = (string) $video->group->keywords;
			//category is a single keyword
			$c[$this->video_object]['category'] = (string) $video->group->category;
			//url is the actual url to the videos page
			$c[$this->video_object]['url'] = (string) $player['url'];
			//urls to thethumbnail images
			$c[$this->video_object]['thumbnail_url1'] = (string) $thumbnail1['url'];
			$c[$this->video_object]['thumbnail_url2'] = (string) $thumbnail2['url'];
			$c[$this->video_object]['thumbnail_url3'] = (string) $thumbnail3['url'];
			$c[$this->video_object]['thumbnail_url4'] = (string) $thumbnail4['url'];

			//magically get the duration for video in seconds
			$yt = $video->children('http://gdata.youtube.com/schemas/2007');
			$duration = $yt->duration->attributes(); //extract from xml
			$c[$this->video_object]['duration'] = (string) $duration['seconds'];

			
			$video = array(); //reset variable
			//magically get the duration for video in seconds
			$video = $entry->children('http://gdata.youtube.com/schemas/2007');
			$views = $video->statistics->attributes();
			
			//if results were returned - removes php warning
			if(!empty($video)){
				//number of times the video has been viewed
				if($views['viewCount']==''){ $c[$this->video_object]['view_count'] = '0'; }
				else{ $c[$this->video_object]['view_count'] = (string) $views['viewCount']; }
				//number of times the video has been set as favorite
				if($views['favoriteCount']==''){ $c[$this->video_object]['favorite_count'] = '0'; }
				else{ $c[$this->video_object]['favorite_count'] = (string) $views['favoriteCount']; }
			} else { //results were not returned
				$c[$this->video_object]['view_count'] = '0';
				$c[$this->video_object]['favorite_count'] = '0';
			}
/*
			$video = array();
			$video = $entry->children('http://schemas.google.com/g/2005');
			$ratings = array();
			//$ratings = $video->rating->attributes();
			$rating = $video->rating;
			
			print_r($i);
			print_r($rating);
			
			if(!empty($video)){
				if(isset($rating)){
					if(!empty($rating)){
						if($ratings['min']==''){ $c[$this->video_object]['min_rating'] = '0'; }
						else{ $c[$this->video_object]['min_rating'] = (string) $ratings['min']; }
						if($ratings['max']==''){ $c[$this->video_object]['max_rating'] = '0'; }
						else{ $c[$this->video_object]['max_rating'] = (string) $ratings['max']; }
						if($ratings['average']==''){ $c[$this->video_object]['avg_rating'] = '0.00'; }
						else{ $c[$this->video_object]['avg_rating'] = (string) $ratings['average']; }
						if($ratings['numRaters']){ $c[$this->video_object]['num_raters'] = '0'; }
						else{ $c[$this->video_object]['num_raters'] = (string) $ratings['numRaters']; }
					} else {
						$c[$this->video_object]['min_rating'] = '0';
						$c[$this->video_object]['max_rating'] = '0';
						$c[$this->video_object]['avg_rating'] = '0.00';
						$c[$this->video_object]['num_raters'] = '0';
					}
				} else {					
						$c[$this->video_object]['min_rating'] = '0';
						$c[$this->video_object]['max_rating'] = '0';
						$c[$this->video_object]['avg_rating'] = '0.00';
						$c[$this->video_object]['num_raters'] = '0';
				}
			}
			
			//check to see if there are any comments/any information about the comments
			//if there is get the feedlink and number of comments
			if ($video->comments->feedLink) {
				$comments = $video->comments->feedLink->attributes();
				//number of comments the video has
				$c[$this->video_object]['comments_count'] = (string) $comments['countHint'];
			}
			*/
			$video_array[] = $c;
			$i++;
		}
		
		//set the array to instance variable $user_videos
		return $video_array;
	}
	
	
	
	/**
	 * Returns the account information of a youtube user.
	 *
	 * <code>
	 *   <?php
	 *   include 'Php5tube.php';
	 *   $php5tube = new Php5tube('Video','User','Comment');
	 *   $user_info = $php5tube->getUserInfo('rickrolled');
	 *   ?>
	 * </code>
	 *   
	 * @param string $user - The account name of the youtube user.
	 * 
	 * @return array array[$this->user_object][<field_name>] where <field_name> =<br />
	 * {'username', 'first_name', 'last_name', 'age', 'hobbies', 'relationship', 'occupation', 'music','movies', 'location', 'hometown', 'gender', 'description'}
	 * 
	 */
	function getUserInfo($user) {

		$authorURL = 'http://gdata.youtube.com/feeds/api/users/' .  $user;

		$xml = @simplexml_load_file($authorURL);
		$author_array = array ();
		if (!empty ($xml)) {
			$author = $xml->children('http://gdata.youtube.com/schemas/2007');
			//user's user name'
			$author_array[$this->user_object]['username'] = (string) $author->username;
			//users first name (if supplied)
			$author_array[$this->user_object]['first_name'] = (string) $author->firstName;
			//users last name (if supplied)
			$author_array[$this->user_object]['last_name'] = (string) $author->lastName;
			//users age (if supplied)
			$author_array[$this->user_object]['age'] = (string) $author->age;
			//users hobbies (if supplied)
			$author_array[$this->user_object]['hobbies'] = (string) $author->hobbies;
			//users relationship (if supplied) ie single, married, etc...
			$author_array[$this->user_object]['relationship'] = (string) $author->relationship;
			//users occupation
			$author_array[$this->user_object]['occupation'] = (string) $author->occupation;
			//favorite music
			$author_array[$this->user_object]['music'] = (string) $author->music;
			//favorite movies (not youtube videos) ... the rest are pretty obvious
			$author_array[$this->user_object]['movies'] = (string) $author->movies;
			$author_array[$this->user_object]['location'] = (string) $author->location;
			$author_array[$this->user_object]['hometown'] = (string) $author->hometown;
			$author_array[$this->user_object]['gender'] = (string) $author->gender;
			$author_array[$this->user_object]['description'] = (string) $author->description;
		}
		return $author_array;
	}
	
	
	
	/**
	 * Returns a list of the most frequently viewed videos on youtube.
	 * 
	 * <code>
	 *   <?php
	 *   include 'Php5tube.php';
	 *   $php5tube = new Php5tube('Video','User','Comment');
	 *   $most_viewed = $php5tube->getMostViewed(1,10);
	 *   ?>
	 * </code>
	 * 
	 * @param int $start_index Start at the nth most viewed video.  The default is to start the number 1 most viewed video.
	 * @param int $max The maximum number of videos returned in list. The default is 25 videos. 
	 * 
	 * @return array array[<numbered_index>][$this->video_object][<field_name>] where <field_name> =<br />
	 * {'youtube_id', 'author', 'title', 'description', 'keywords', 'url', 'thumbnail1', 'thumbnail2', 'thumbnail3', 'thumbnail4', 'length', 'view_count', 'favorite_count', 'comments_count'}
	 * 
	 */
	function getMostViewed($start_index = 1, $max = 25) {
		$feedURL = 'http://gdata.youtube.com/feeds/api/standardfeeds/most_viewed?start-index=' . $start_index . '&max-results=' . $max;
		$xml = @simplexml_load_file($feedURL);
		$video_array = array (); //holds the video objects
		$i = 0;
		foreach ($xml->entry as $entry) {
			//id is the full url to get the video feed.  the characters after the last slash is the actual video id
			//so id here could be 'http://gdata.youtube.com/feeds/api/videos/2jkExrrm_sQ'  with the actual video id being 2jkExrrm_sQ
			$c = array(); //reset memory for temp video object
			//extract youtube id from url
			$c[$this->video_object]['youtube_id'] = preg_replace('/http:\/\/gdata.youtube.com\/feeds\/api\/videos\//','',(string) $entry->id);
			$c[$this->video_object]['author'] = $entry->author->name;
			
			$video = array(); //reset variable
			//magically gets new variables for each video
			$video = $entry->children('http://search.yahoo.com/mrss/');
			$player = $video->group->player->attributes(); //get value for player variable
			$thumbnail1 = $video->group->thumbnail[0]->attributes(); //get value for first thumbnail variable
			$thumbnail2 = $video->group->thumbnail[1]->attributes(); //get value for first thumbnail variable
			$thumbnail3 = $video->group->thumbnail[2]->attributes(); //get value for first thumbnail variable
			$thumbnail4 = $video->group->thumbnail[3]->attributes(); //get value for first thumbnail variable
			
			$c[$this->video_object]['title'] = (string) $video->group->title;
			$c[$this->video_object]['description'] = (string) $video->group->description;
			//keywords are a number of keywords in one string separated by commas
			$c[$this->video_object]['keywords'] = (string) $video->group->keywords;
			//category is a single keyword
			$c[$this->video_object]['category'] = (string) $video->group->category;
			//url is the actual url to the videos page
			$c[$this->video_object]['url'] = (string) $player['url'];
			//urls to thethumbnail images
			$c[$this->video_object]['thumbnail_url1'] = (string) $thumbnail1['url'];
			$c[$this->video_object]['thumbnail_url2'] = (string) $thumbnail2['url'];
			$c[$this->video_object]['thumbnail_url3'] = (string) $thumbnail3['url'];
			$c[$this->video_object]['thumbnail_url4'] = (string) $thumbnail4['url'];

			//magically get the duration for video in seconds
			$yt = $video->children('http://gdata.youtube.com/schemas/2007');
			$duration = $yt->duration->attributes(); //extract from xml
			$c[$this->video_object]['duration'] = (string) $duration['seconds'];

			
			$video = array(); //reset variable
			//magically get the duration for video in seconds
			$video = $entry->children('http://gdata.youtube.com/schemas/2007');
			$views = $video->statistics->attributes();
			
			//if results were returned - removes php warning
			if(!empty($video)){
				//number of times the video has been viewed
				if($views['viewCount']==''){ $c[$this->video_object]['view_count'] = '0'; }
				else{ $c[$this->video_object]['view_count'] = (string) $views['viewCount']; }
				//number of times the video has been set as favorite
				if($views['favoriteCount']==''){ $c[$this->video_object]['favorite_count'] = '0'; }
				else{ $c[$this->video_object]['favorite_count'] = (string) $views['favoriteCount']; }
			} else { //results were not returned
				$c[$this->video_object]['view_count'] = '0';
				$c[$this->video_object]['favorite_count'] = '0';
			}
/*
			$video = array();
			$video = $entry->children('http://schemas.google.com/g/2005');
			$ratings = array();
			//$ratings = $video->rating->attributes();
			$rating = $video->rating;
			
			print_r($i);
			print_r($rating);
			
			if(!empty($video)){
				if(isset($rating)){
					if(!empty($rating)){
						if($ratings['min']==''){ $c[$this->video_object]['min_rating'] = '0'; }
						else{ $c[$this->video_object]['min_rating'] = (string) $ratings['min']; }
						if($ratings['max']==''){ $c[$this->video_object]['max_rating'] = '0'; }
						else{ $c[$this->video_object]['max_rating'] = (string) $ratings['max']; }
						if($ratings['average']==''){ $c[$this->video_object]['avg_rating'] = '0.00'; }
						else{ $c[$this->video_object]['avg_rating'] = (string) $ratings['average']; }
						if($ratings['numRaters']){ $c[$this->video_object]['num_raters'] = '0'; }
						else{ $c[$this->video_object]['num_raters'] = (string) $ratings['numRaters']; }
					} else {
						$c[$this->video_object]['min_rating'] = '0';
						$c[$this->video_object]['max_rating'] = '0';
						$c[$this->video_object]['avg_rating'] = '0.00';
						$c[$this->video_object]['num_raters'] = '0';
					}
				} else {					
						$c[$this->video_object]['min_rating'] = '0';
						$c[$this->video_object]['max_rating'] = '0';
						$c[$this->video_object]['avg_rating'] = '0.00';
						$c[$this->video_object]['num_raters'] = '0';
				}
			}
			
			//check to see if there are any comments/any information about the comments
			//if there is get the feedlink and number of comments
			if ($video->comments->feedLink) {
				$comments = $video->comments->feedLink->attributes();
				//number of comments the video has
				$c[$this->video_object]['comments_count'] = (string) $comments['countHint'];
			}
			*/
			$video_array[] = $c;
			$i++;
		}
		
		//set the array to instance variable $user_videos
		return $video_array;
	}
	
	
	
	/**
	 * Returns the video comments of a youtube video.<br />
	 * Note: this function does not set the next starting index instance variable in the class.
	 * 
	 * <code>
	 *   <?php
	 *   include 'Php5tube.php';
	 *   $php5tube = new Php5tube('Video','User','Comment');
	 *   $vid_comments = $php5tube->getVideoComments('oHg5SJYRHA0',1,10);
	 *   ?>
	 * </code>
	 * 
	 * @param string $id The video's youtube id.
	 * @param int start_index The first entry returned.
	 * @param int max The number of results returned.
	 * 
	 * @return array array[<numbered_index>][$this->video_object][<field_name>] where <field_name> =<br />
	 * {'youtube_id', 'author','title','content','updated','published'}
	 * 
	 */
	 
	function getVideoComments($id,$start_index=1,$max=25) {
		$commentURL = 'http://gdata.youtube.com/feeds/api/videos/' . $id. '/comments?start-index='.$start_index.'&max-results='.$max;
		$xml = @simplexml_load_file($commentURL);
		
		$comment_array = array();
		$i=0;
		//check to see if we've reached the end of the feed pages
		//if there is no link to the next set of comments we are done.
		//so either set this->next_index to the next start_index or set it to -1 to notify the user we are done.
		/*
		if(!empty($xml->link[6]))
		{
			$this->next_index = $start_index + $max;
		}
		else
		{
			$this->next_index = -1;
		}
		*/
		foreach($xml->entry as $entry)
		{
			$comment_array[$i][$this->comment_object]['youtube_id'] = $id;
			//get the author's name
			$comment_array[$i][$this->comment_object]['author'] = (string)$entry->author->name;
			//get title of the comment
			$comment_array[$i][$this->comment_object]['title'] = (string)$entry->title;
			//get comment content
			$comment_array[$i][$this->comment_object]['content'] = (string)$entry->content;
			//get the last time the comment was updated
			$comment_array[$i][$this->comment_object]['updated'] = $entry->updated;
			//get the time the comment was published
			$comment_array[$i][$this->comment_object]['published'] = $entry->published;
			$i++;
		}
		
		return $comment_array;
	}
	


	/**
	 * Returns the information of a youtube video.
	 * 
	 * <code>
	 *   <?php
	 *   include 'Php5tube.php';
	 *   $php5tube = new Php5tube('Video','User','Comment');
	 *   $vid_info = $php5tube->getVideoInfo('oHg5SJYRHA0');
	 *   ?>
	 * </code>
	 * 
	 * @param string $id - The video's youtube id.
	 * 
	 * @return array array[$this->video_object][<field_name>] where <field_name> =<br />
	 * {'youtube_id', 'author', 'title', 'description', 'keywords', 'url', 'thumbnail1', 'thumbnail2', 'thumbnail3', 'thumbnail4', 'length', 'view_count', 'favorite_count', 'comments_count'}
	 * 
	 */
	 
	function getVideoInfo($id) {
		//set up the feed url
		$feedURL = 'http://gdata.youtube.com/feeds/api/videos/' . $id;
		//read the feed and place it in an simple_xml object
		$xml = @simplexml_load_file($feedURL);
		//create an empty array to deal with foreach loops incase nothing is returned from the feed query
		$video_array = array ();
		
		//if the query returned a value and the xml object is not empty
		if (!empty ($xml)) {
			
			//store the youtube_id in the object.
			$video_array[$this->video_object]['youtube_id'] = $id;
			//get the authors name
			$video_array[$this->video_object]['author'] = $xml->author->name;
			$video = $xml->children('http://search.yahoo.com/mrss/');

			$player = $video->group->player->attributes();
			$thumbnail1 = $video->group->thumbnail[0]->attributes(); //get value for first thumbnail variable
			$thumbnail2 = $video->group->thumbnail[1]->attributes(); //get value for first thumbnail variable
			$thumbnail3 = $video->group->thumbnail[2]->attributes(); //get value for first thumbnail variable
			$thumbnail4 = $video->group->thumbnail[3]->attributes(); //get value for first thumbnail variable
			//get the url to the thumbnails for the video 
			$video_array[$this->video_object]['thumbnail_url1'] = (string) $thumbnail1['url'];
			$video_array[$this->video_object]['thumbnail_url2'] = (string) $thumbnail2['url'];
			$video_array[$this->video_object]['thumbnail_url3'] = (string) $thumbnail3['url'];
			$video_array[$this->video_object]['thumbnail_url4'] = (string) $thumbnail4['url'];
			
			//get the video's title
			$video_array[$this->video_object]['title'] = (string) $video->group->title;
			//get the video's description
			$video_array[$this->video_object]['description'] = (string) $video->group->description;
			//get the video's category
			$video_array[$this->video_object]['category'] = (string)$video->group->category;
			//get the video's tags/keywords
			$video_array[$this->video_object]['keywords'] = (string) $video->group->keywords;
			//get the url to the video
			$video_array[$this->video_object]['url'] = (string) $player['url'];
			
			
			$yt = $video->children('http://gdata.youtube.com/schemas/2007');
			$length = $yt->duration->attributes();
			//get the video length in seconds
			$video_array[$this->video_object]['length'] = (string) $length['seconds'];
			$video = $xml->children('http://gdata.youtube.com/schemas/2007');
			//get the number of times the video has been viewed and marked as favorite
			$views = $video->statistics->attributes();
			
			
			//if results were returned - removes php warning
			if(!empty($video)){
				//number of times the video has been viewed
				if($views['viewCount']==''){ $video_array[$this->video_object]['view_count'] = '0'; }
				else{ $video_array[$this->video_object]['view_count'] = (string) $views['viewCount']; }
				//number of times the video has been set as favorite
				if($views['favoriteCount']==''){ $video_array[$this->video_object]['favorite_count'] = '0'; }
				else{ $video_array[$this->video_object]['favorite_count'] = (string) $views['favoriteCount']; }
			} else { //results were not returned
				$video_array[$this->video_object]['view_count'] = '0';
				$video_array[$this->video_object]['favorite_count'] = '0';
			}

			$video = $xml->children('http://schemas.google.com/g/2005');
			
			//check to see if there are any comments/any information about the comments
			//if there is get the feedlink and number of comments
			if ($video->comments->feedLink) {
				$comments = $video->comments->feedLink->attributes();
				//get the number of comments for the video
				$video_array[$this->video_object]['comments_count'] = (string) $comments['countHint'];
			}
		}
		
		//return the current video array
		return $video_array;

	}
		
	/*
	function getVideosByKeywords($keywords,$start_index,$max_results, $order)
	{
		$feedURL = '';
	}
	
	/**
	 * function getVideosByCategory
	 * returns a list of videos which fall under a certain category
	 * 
	 *$category - category of videos you want to see (can be the url or the category)
	 * 
	 * @return an array structured like array[<numbered_index>][$this->video_object][<field_name>]
	 * 
	 * <field_name> = {'id','title','description','keywords','url','thumbnail','length','views','comments_url','comments_count'}
	 * 
	function getVideosByCategory($category,$max = 25, $order) {
		//pull out the category incase the user gave us the whole url.. 
		//this is to make it easier for the user to use data from one query to launch this one
		$feedURL = 'http://gdata.youtube.com/feeds/api/videos/-/' .  $category  . '?max-results=' . $max;
		$xml = simplexml_load_file($feedURL);
		$video_array = array ();
		$i = 0;
		foreach ($xml->entry as $entry) {
			//id is the full url to get the video feed.  the characters after the last slash is the actual video id
			//so id here could be 'http://gdata.youtube.com/feeds/api/videos/2jkExrrm_sQ'  with the actual video id being 2jkExrrm_sQ
			$video_array[$i][$this->video_object]['id'] = (string) $entry->id;
			$video = $entry->children('http://search.yahoo.com/mrss/');
			$player = $video->group->player->attributes();
			$thumbnail = $video->group->thumbnail[0]->attributes();

			
			$video_array[$i][$this->video_object]['title'] = (string) $video->group->title;
			$video_array[$i][$this->video_object]['description'] = (string) $video->group->description;
			//keywords are a number of keywords in one string separated by commas
			$video_array[$i][$this->video_object]['keywords'] = (string) $video->group->keywords;
			//url is the actual url to the videos page
			$video_array[$i][$this->video_object]['url'] = (string) $player['url'];
			//url to the first thumbnail image 
			$video_array[$i][$this->video_object]['thumbnail'] = (string) $thumbnail['url'];

			$yt = $video->children('http://gdata.youtube.com/schemas/2007');
			$length = $yt->duration->attributes();
			//videos length in seconds
			$video_array[$i][$this->video_object]['length'] = (string) $length['seconds'];

			$video = $entry->children('http://gdata.youtube.com/schemas/2007');
			$views = $video->statistics->attributes();
			
			//number of times the video has been watched
			$video_array[$i][$this->video_object]['views'] = (string) $views['viewCount'];

			$video = $entry->children('http://schemas.google.com/g/2005');

			//check to see if there are any comments/any information about the comments
			//if there is get the feedlink and number of comments
			if ($video->comments->feedLink) {
				$comments = $video->comments->feedLink->attributes();
				//number of comments the video has
				$video_array[$i][$this->video_object]['comments_count'] = (string) $comments['countHint'];
			}

			$i++;
		}
		return $video_array;
	}
	
	*/	
	 
	 function _GetVideoIdFromUrl($url) {
		$parts = explode('?v=',$url);
		if (count($parts) == 2) {
			$tmp = explode('&',$parts[1]);
			if (count($tmp)>1) {
				return $tmp[0];
			} else {
				return $parts[1];
			}
		} else {
			return $url;
		}
	}
	 
	/*
	* parseHtml.php
	* Author: Carlos Costa Jordao
	* Email: carlosjordao@yahoo.com
	*
	* My notation of variables:
	* i_ = integer, ex: i_count
	* a_ = array, a_html
	* b_ = boolean,
	* s_ = string
	*
	* What it does:
	* - parses a html string and get the tags
	* - exceptions: html tags like <br> <hr> </a>, etc
	* - At the end, the array will look like this:
	* ["IMG"][0]["SRC"] = "xxx"
	* ["IMG"][1]["SRC"] = "xxx"
	* ["IMG"][1]["ALT"] = "xxx"
	* ["A"][0]["HREF"] = "xxx"
	*
	*/
	function parseHtml($s_str=NULL){				
		$i_indicatorL = 0;
		$i_indicatorR = 0;
		$s_tagOption = "";
		$i_arrayCounter = 0;
		$a_html = array();
		// Search for a tag in string
		while( is_int(($i_indicatorL=strpos($s_str,"<",$i_indicatorR))) ) {
			// Get everything into tag...
			$i_indicatorL++;
			$i_indicatorR = strpos($s_str,">", $i_indicatorL);
			$s_temp = substr($s_str, $i_indicatorL, ($i_indicatorR-$i_indicatorL) );
			$a_tag = explode( ' ', $s_temp );
			// Here we get the tag's name
			list( ,$s_tagName,, ) = each($a_tag);
			$s_tagName = strtoupper($s_tagName);
			// Well, I am not interesting in <br>, </font> or anything else like that...
			// So, this is false for tags without options.
			$b_boolOptions = is_array(($s_tagOption=each($a_tag))) && $s_tagOption[1];
			if( $b_boolOptions ) {
				// Without this, we will mess up the array
				//$i_arrayCounter = (int)count($a_html[$s_tagName]);
				// get the tag options, like src="htt://". Here, s_tagTokOption is 'src' and s_tagTokValue is '"http://"'
				
				do {
					$s_tagTokOption = strtoupper(strtok($s_tagOption[1], "="));
					$s_tagTokValue = trim(strtok("="));
					$a_html[$s_tagName][$i_arrayCounter][$s_tagTokOption] = $s_tagTokValue;
					$b_boolOptions = is_array(($s_tagOption=each($a_tag))) && $s_tagOption[1];
				} while( $b_boolOptions );
			}
		}
		$ytUrl = substr($a_html['EMBED'][0]['SRC'],1);
		$ytUrlArr = explode("/", $ytUrl);
		$ytIdArr =explode("&", $ytUrlArr[count($ytUrlArr)-1]);
		$ytId = $ytIdArr[0];
		return $ytId;
	}
	
	function EmbedVideo($videoid,$width = 425,$height = 350) {
		$videoid = $this->_GetVideoIdFromUrl($videoid);
		return '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$videoid.'"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$videoid.'" type="application/x-shockwave-flash" wmode="transparent" width="'.$width.'" height="'.$height.'"></embed></object>';
	}

	function VideoInfo($s_str=NULL){
		$object_tag = NULL;
		$vid_info_current = NULL;
		if($s_str){
			if(stristr($s_str, '</object>')){
				$ytId = $this->parseHtml($s_str);
			}elseif(stristr($s_str, 'youtube.com')){
				$ytId = $this->_GetVideoIdFromUrl($s_str);
				$object_tag = $this->EmbedVideo($ytId);
			}else{
				return false;
			}
			if(strlen($ytId)==11){
				$vid_info = $this->getVideoInfo($ytId);
				foreach($vid_info as $vid_info_current){
					//print_r($vid_info_current);				
				}
				if($object_tag && $vid_info_current){
					$vid_info_current['object_tag'] = $object_tag; 
				}
				return ($vid_info_current);	
			}else{
				return false;
			}
		}
		return false;
	}
}
?>