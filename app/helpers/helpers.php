<?php

function nameImage(string $extension)
{
  return 'img_' . time() . '.' . $extension;
}
