<?php

function nameImage(string $extension)
{
  return 'img_' . time() . '.' . $extension;
}

function stars_movies($votes)
{
  $star = '';

  if ($votes === 0) {
    $star = 'calificación no disponible';
  } else if ($votes > 0 && $votes <= 500) {
    $star = '⭐';
  } else if ($votes > 500 && $votes <= 1000) {
    $star = '⭐⭐';
  } else if ($votes > 1000 && $votes <= 1500) {
    $star = '⭐⭐⭐';
  } else if ($votes > 1500 && $votes <= 3000) {
    $star = '⭐⭐⭐⭐';
  } else if ($votes > 3000) {
    $star = '⭐⭐⭐⭐⭐';
  }
  return $star;
}
