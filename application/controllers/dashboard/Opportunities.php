<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunities extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('opportunity_model');
      $this->load->model('conversation_model');
    $this->load->model('contact_model');
      /*
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->postal->add('You are not allowed to visit the Users page','error');
          redirect('dashboard');
      }*/
  }

  public function index()
  {
    $this->data['opportunities'] = $this->opportunity_model->with_status('fields:status')->with_source('fields:source')->with_contact('fields:first_name,last_name,email,phone,contact_type')->where(array('status'=>'1', 'assigned_to'=>'0'))->order_by('created_at','DESC')->get_all();
    $this->data['my_opportunities'] = $this->opportunity_model->with_status('fields:status')->with_source('fields:source')->where(array('assigned_to'=>$_SESSION['user_id']))->order_by('updated_at','DESC')->get_all();
    $this->data['unread_opportunities'] = $this->opportunity_model->with_status('fields:status')->with_source('fields:source')->where(array('assigned_to'=>$_SESSION['user_id'],'read'=>'0'))->order_by('updated_at','DESC')->get_all();
    $this->render('dashboard/opportunities/index_view');
  }


  public function create($contact_id = 0, $autoinsert = NULL, $value = NULL)
  {
    $contact = FALSE;
    if ($contact_id !== 0)
    {
      $contact = $this->contact_model->get($contact_id);
      if($contact!==FALSE) {
        $this->data['contact'] = $contact;
      }
    }

    if(isset($autoinsert) && isset($value) && (in_array($autoinsert,array('by_uid','by_phone','by_email'))))
    {
      $this->data[$autoinsert] = urldecode($value);
    }
    $this->data['page_title'] = 'Create contact';

    if($contact===FALSE) {
      $this->form_validation->set_rules('contact_type', 'Contact type', 'trim|is_natural_no_zero|required');
      $this->form_validation->set_rules('first_name', 'First name', 'trim');
      $this->form_validation->set_rules('last_name', 'Last name', 'trim');
      $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[contacts.email]|required');
      $this->form_validation->set_rules('phone', 'Phone', 'trim');
      $this->form_validation->set_rules('sex', 'Sex', 'trim|in_list[-,M,F]|required');
      $this->form_validation->set_rules('birthday', 'Birthday', 'trim');
      $this->form_validation->set_rules('address', 'Address', 'trim');
      $this->form_validation->set_rules('postal_code', 'Postal code', 'trim|numeric');
      $this->form_validation->set_rules('city', 'City', 'trim|is_natural');
      $this->form_validation->set_rules('uid', 'UID', 'trim');
      $this->form_validation->set_rules('info', 'Info', 'trim');
    }

    else {
      $this->form_validation->set_rules('contact_id', 'Contact ID', 'trim|is_natural_no_zero|required');
    }

    $this->form_validation->set_rules('title','Title','trim|required');
    $this->form_validation->set_rules('description','Description','trim');
    $this->form_validation->set_rules('source','Source','trim|is_natural_no_zero|required');
    $this->form_validation->set_rules('status','Status','trim|is_natural_no_zero|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->model('opportunity_status_model');
      $this->data['status'] = $this->opportunity_status_model->order_by('order','ASC')->as_dropdown('status')->get_all();
      $this->load->model('opportunity_source_model');
      $this->data['sources'] = $this->opportunity_source_model->order_by('source','ASC')->as_dropdown('source')->get_all();
      $this->load->model('contact_type_model');
      $this->data['contact_types'] = $this->contact_type_model->order_by('title','ASC')->as_dropdown('title')
          ->get_all();
      $this->data['sex'] = array('-' => 'Sex','M' => 'M','F'=>'F');
      $this->load->model('city_model');
      $this->data['cities'] = $this->city_model->as_dropdown('name')->order_by('name','ASC')->get_all();
      if($this->data['cities']===FALSE)
      {
        $this->data['cities'] = array();
      }
      array_unshift($this->data['cities'],'Localitate');
      //print_r($customer_types);
      $this->render('dashboard/opportunities/create_view');
    }
    else
    {
      if($contact===FALSE)
      {
        $new_contact = array(
          'contact_type' => $this->input->post('contact_type'),
          'first_name' => $this->input->post('first_name'),
          'last_name' => $this->input->post('last_name'),
          'email' => $this->input->post('email'),
          'phone' => $this->input->post('phone'),
          'sex' => $this->input->post('sex'),
          'birthday' => $this->input->post('birthday'),
          'address' => $this->input->post('address'),
          'postal_code' => $this->input->post('postal_code'),
          'city' => $this->input->post('city'),
          'uid' => $this->input->post('uid'),
          'info' => $this->input->post('info')
        );

        $contact_id = $this->contact_model->insert($new_contact);

        if($contact_id===FALSE)
        {
          $this->rat->log('Had problem inserting new contact from opportunities page',0,$_SESSION['user_id']);
          $this->postal->add('There was a problem inserting the new contact. Press "Back and try again".','error');
          redirect('dashboard/opportunities');
        }
        else
        {
          $this->rat->log('New contact with id '.$contact_id.' inserted from opportunities page',1,$_SESSION['user_id']);
          $this->postal->add('Contact added successfully.','success');
        }
      }
      else
      {
        $contact_id = $this->input->post('contact_id');
      }

      $new_opportunity = array(
        'contact_id' => $contact_id,
        'title' => $this->input->post('title'),
        'description' => $this->input->post('description'),
        'assigned_to' => $_SESSION['user_id'],
        'source' => $this->input->post('source'),
        'status' => $this->input->post('status'),
        'read' => '1'
      );
      $opportunity_id = $this->opportunity_model->insert($new_opportunity);
      if($opportunity_id===FALSE)
      {
        $this->rat->log('Had a problem inserting an opportunity for contact id '.$contact_id,0,$_SESSION['user_id']);
        $this->postal->add('Couldn\'t add opportunity although a contact was added','error');
      }
      else
      {
        $this->rat->log('Added opportunity with id '.$opportunity_id,1,$_SESSION['user_id']);
        $this->postal->add('Opportunity added successfully','success');
      }
      redirect('dashboard/opportunities');
    }
  }

  public function search()
  {
    $this->data['search_results'] = array(
        'by_phone'=>'Contacts by phone',
        'by_uid'=>'Contacts by unique ID',
        'by_email'=>'Contacts by email');

    $this->form_validation->set_rules('search','Search','trim|required');
    if($this->form_validation->run()===FALSE)
    {
      redirect('dashboard/contacts');
    }
    if($this->form_validation->numeric($this->input->post('search')))
    {
      $number = trim($this->input->post('search'));
      $this->data['by_phone'] = $this->contact_model->where('phone',$number)->with_type('fields:title')
          ->with_city('fields:name')->get_all();

    }
    elseif($this->form_validation->valid_email($this->input->post('search')))
    {
      $email = trim($this->input->post('search'));
      $this->data['by_email'] = $this->contact_model->where('email',$email)->with_type('fields:title')
          ->with_city('fields:name')->get_all();
    }
    elseif($this->form_validation->alpha_dash($this->input-post('search')))
    {
      $uid = trim($this->input->post('search'));
      $this->data['by_uid'] = $this->contact_model->where('uid',$uid)->with_type('fields:title')
          ->with_city('fields:name')->get_all();
    }
    $this->data['search_value'] = trim($this->input->post('search'));
    $this->render('dashboard/opportunities/index_search_view');
  }

  public function take($id)
  {
    $id = (int) $id;
    $opportunity = $this->opportunity_model->with_user('fields:email')->get($id);
    if($opportunity->assigned_to !== '0')
    {
      $this->postal->add('Opportunity already taken by '.$opportunity->user->email,'error');
      redirect('dashboard/opportunities');
    }
    else
    {
        $this->load->helper('string');
        $opportunity_url = random_string('alnum',20);
        $opportunity_pass = random_string('alnum',8);
      $this->opportunity_model->update(array('assigned_to'=>$_SESSION['user_id'],'status'=>'2','read'=>'1','url'=>$opportunity_url,'password'=>$opportunity_pass), array('id'=>$id));
    }
  }

  public function details($id)
  {
      $opportunity = $this->opportunity_model->where('assigned_to',$_SESSION['user_id'])->get($id);
      // if there is no opportunity, redirect
      if($opportunity===FALSE)
      {
          redirect('opportunities');
      }
      $this->data['opportunity'] = $opportunity;

      //get the contact of this opportunity
      $contact = $this->contact_model->with_city('fields:name')->with_type('fields:title')->get($opportunity->contact_id);
      //if there is no contact, then... oups
      if($contact===FALSE)
      {
          $this->rat->log('There is an opportunity without a contact attached: id '.$opportunity->id);
          $this->postal->add('The opportunity has no contact attached to it... which is weird. Contact administrator','error');
      }
      $this->data['contact'] = $contact;

      // let's get the conversations regarding this opportunity
      $conversations = $this->conversation_model->where('opportunity_id',$opportunity->id)->order_by('created_at','DESC')->get_all();
      $this->data['conversations'] = $conversations;



      $this->load->model('opportunity_source_model');
      $this->data['sources'] = $this->opportunity_source_model->order_by('source','ASC')->as_dropdown('source')->get_all();

      $this->data['source_links'] = $this->opportunity_source_model->order_by('source','ASC')->get_all();

      $this->load->model('opportunity_status_model');
      $this->data['status'] = $this->opportunity_status_model->order_by('order','ASC')->as_dropdown('status')->get_all();

      $this->render('dashboard/opportunities/details_view');
  }

    public function edit($opportunity_id = NULL)
    {
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('description','Description','trim');
        $this->form_validation->set_rules('source','Source','trim|is_natural_no_zero|required');
        $this->form_validation->set_rules('status','Status','trim|is_natural_no_zero|required');
        $this->form_validation->set_rules('opportunity_id','trim|is_natural_no_zero|required');

        if($this->form_validation->run()===FALSE)
        {
            $opportunity_id = isset($opportunity_id) ? $opportunity_id : $this->input->post('opportunity_id');
            $opportunity = $this->opportunity_model->where('assigned_to',$_SESSION['user_id'])->get($opportunity_id);

            if($opportunity==FALSE)
            {
                redirect('opportunities');
            }

            $this->data['opportunity'] = $opportunity;

            $this->load->model('opportunity_source_model');
            $this->data['sources'] = $this->opportunity_source_model->order_by('source','ASC')->as_dropdown('source')->get_all();

            $this->load->model('opportunity_status_model');
            $this->data['status'] = $this->opportunity_status_model->order_by('order','ASC')->as_dropdown('status')->get_all();

            $this->render('dashboard/opportunities/edit_view');
        }
        else
        {
            $updated_opportunity = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'source' => $this->input->post('source'),
                    'status' => $this->input->post('status'),
                    'read' => '1'
            );
            $opportunity_id = $this->input->post('opportunity_id');
            if($this->opportunity_model->update($updated_opportunity,$opportunity_id))
            {
                $this->rat->log('Edited opportunity with id '.$opportunity_id,1,$_SESSION['user_id']);
                $this->postal->add('Opportunity edited successfully','success');
            }
            else
            {
                $this->rat->log('Had a problem editing opportunity '.$opportunity_id,0,$_SESSION['user_id']);
                $this->postal->add('Couldn\'t edit opportunity','error');
            }
            redirect('dashboard/opportunities/details/'.$opportunity_id);
        }
    }

  public function delete($id = NULL)
  {
    echo 'why would you?... Anyway... you can\'t delete an opportunity. It\'s your shame to wear.';
    /*
    if(is_null($id))
    {
      $this->postal->add('There\'s no contact to delete','error');
    }
    elseif($this->customer_model->delete($id))
    {
      $this->rat->log('Deleted contact with id '.$id,0,$_SESSION['user_id']);
      $this->postal->add('Contact deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the contact','error');
    }
    redirect('dashboard/contacts');
    */
  }
}