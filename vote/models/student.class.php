<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2018/1/14
 * Time: 21:24
 */
require_once ('vote.class.php');

class StudentVote extends VoteModel
{
    protected $voted_table = 's_voters';
    protected $vote_list_table = 's_vote_lists';
}