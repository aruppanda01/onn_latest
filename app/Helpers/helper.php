<?php

function randomGenerator()
{
	return uniqid() . '' . date('ymdhis') . '' . uniqid();
}

function imageUpload($image, $folder = 'image')
{
	$random = randomGenerator();
	$image->move('upload/' . $folder . '/', $random . '.' . $image->getClientOriginalExtension());
	$imageurl = 'upload/' . $folder . '/' . $random . '.' . $image->getClientOriginalExtension();
	return $imageurl;
}
