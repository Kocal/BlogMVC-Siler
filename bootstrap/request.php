<?php
use function Siler\Container\set;
use Illuminate\Http\Request;

set('request', Request::capture());
