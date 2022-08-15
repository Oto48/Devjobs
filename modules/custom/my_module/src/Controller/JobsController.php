<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class JobsController extends ControllerBase {

    public function showContent() {

        $title = \Drupal::request()->query->get('title');
        $location = \Drupal::request()->query->get('location');
        $full_time = \Drupal::request()->query->get('full-time');

        $jobs = [];


        $query = \Drupal::entityQuery('node');
        $query->condition('type', 'jobs');

        if($title)
            $query->condition('title', $title, 'CONTAINS');
        if($location)
            $query->condition('field_country', $location, 'CONTAINS');
        if($full_time)
            $query->condition('field_employment', 'Full Time', 'CONTAINS');

        $nids = $query->execute();

        foreach ($nids as $nid){
            $node = Node::load($nid);
            $title = $node->getTitle();
            $company = $node->field_company->getValue()[0]['value'];
            $employment = $node->field_employment->getValue()[0]['value'];
            $upload_date = $node->field_upload_date->getValue()[0]['value'];
            $country = $node->field_country->getValue()[0]['value'];
            $image = file_create_url($node->field_company_logo->entity->getFileUri());
            $newDate = date("d-m-Y", $upload_date);

            $data = array(
                "id" => $nid,
                "title" => $title,
                "company" => $company,
                "employment" => $employment,
                "upload_date" => $newDate,
                "image" => $image,
                "country" => $country
            );

            array_push($jobs, $data);
        }

        // dump($jobs);


        return [
            '#theme' => 'jobs_page',
            '#title' => 'Jobs Page',
            '#items' => $jobs,
        ];

    }
}