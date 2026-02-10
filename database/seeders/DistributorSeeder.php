<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $distributors = [
            ['company' => 'OVERLEAF', 'contact_person' => 'Mr Seshadri Subramanium', 'contact_information' => '9811099790', 'email_id' => 'sesh@overleaf.co.in', 'city' => 'Gurgaoun', 'state_wise_distribution' => 'Delhi'],
            ['company' => 'Variety Books Depot', 'contact_person' => 'Mr OM Arora', 'contact_information' => '1123412567', 'email_id' => 'varietybookdepot@gmail.com', 'city' => 'Delhi', 'state_wise_distribution' => 'North India - Exclusive'],
            ['company' => 'Children Knowledge Center', 'contact_person' => 'Mr Sandeep Arrora', 'contact_information' => '9811608009', 'email_id' => 'topperbooksindia@gmail.com', 'city' => 'Faridabad', 'state_wise_distribution' => 'Delhi'],
            ['company' => 'Adhinath Book Depot', 'contact_person' => 'Mr Damaji', 'contact_information' => '9892971893', 'email_id' => 'adhinathbooksales@gmail.com', 'city' => 'Mumbai', 'state_wise_distribution' => 'Maharashtra'],
            ['company' => 'Book Wish', 'contact_person' => 'Mr Amit Agarwal', 'contact_information' => '9830889447', 'email_id' => 'amit@bookwish.in', 'city' => 'Kolkatta', 'state_wise_distribution' => 'West Bengal'],
            ['company' => 'Story Teller', 'contact_person' => 'Mrs Mayuri Mishra', 'contact_information' => '9331051191', 'email_id' => 'AJAY@AMISRA.IN', 'city' => 'kolkatta', 'state_wise_distribution' => 'West Bengal'],
            ['company' => 'AK Mishra', 'contact_person' => 'Mr Arun Mishra', 'contact_information' => '0671-2322244', 'email_id' => 'akmishraagenciespvtltd@rediffmail.com', 'city' => 'Cuttack', 'state_wise_distribution' => 'Orissa'],
            ['company' => 'Padmavathi Book Store', 'contact_person' => 'Mr PVB', 'contact_information' => '9848025306', 'email_id' => 'leotechpress@gmail.com', 'city' => 'Hyderabad', 'state_wise_distribution' => 'Andra Pradesh'],
            ['company' => 'Central Book Store', 'contact_person' => 'Mr Sathish', 'contact_information' => '9121152062', 'email_id' => 'KSATISHMENON@CENTRALBOOKS.IN', 'city' => 'Hyderabad', 'state_wise_distribution' => 'Andhrapradesh & Telengana'],
            ['company' => 'Prism Books', 'contact_person' => 'Mr Pranesh', 'contact_information' => '9845046202', 'email_id' => 'BHARATHI@PRISMBOOKS.COM', 'city' => 'Bangalore', 'state_wise_distribution' => 'Karnataka'],
            ['company' => 'Satish book Agency', 'contact_person' => 'Satish Kumar', 'contact_information' => '881630123', 'email_id' => 'Satishbookagency@gmail.com', 'city' => 'Bangalore', 'state_wise_distribution' => 'Karnataka'],
            ['company' => 'Sapna Book House', 'contact_person' => 'Mr.Deepak Shah', 'contact_information' => '8067415553', 'email_id' => 'cs@sapnaonline.com', 'city' => 'Bangalore', 'state_wise_distribution' => 'Karnataka'],
            ['company' => 'Confidant Books', 'contact_person' => 'Mrs Philomina Coutinho', 'contact_information' => '9370273479', 'email_id' => 'CONFIDANTINDIA@GMAIL.COM', 'city' => 'MarGoa', 'state_wise_distribution' => 'Goa'],
            ['company' => 'Natraj Book Company', 'contact_person' => 'Mr. Rajiv H doshi', 'contact_information' => '8347961299', 'email_id' => 'natraj1963@gmail.com', 'city' => 'Ahmedabad', 'state_wise_distribution' => 'Gujrat'],
            ['company' => 'Royal Book Company', 'contact_person' => 'Mr.Sanjay Garg', 'contact_information' => '9314509048', 'email_id' => 'SANJAYGARG767@GMAIL.COM', 'city' => 'Jaipur', 'state_wise_distribution' => 'Rajasthan'],
            ['company' => 'Sak- San\'s Books', 'contact_person' => 'SL Shankar', 'contact_information' => '9789919892', 'email_id' => 'saksanbooks@gmail.com', 'city' => 'Chennai', 'state_wise_distribution' => 'Tamil Nadu'],
            ['company' => 'Global Web Learning Solution', 'contact_person' => 'Mr Prabhu Rasamanickam', 'contact_information' => '9787449933', 'email_id' => 'Sales@globalweblearningsolution.in', 'city' => 'Coimbatore', 'state_wise_distribution' => 'Tamil Nadu'],
            ['company' => 'Mayura Books', 'contact_person' => 'Mr Kellyappan', 'contact_information' => '+91 90923 74922', 'email_id' => 'mayurabooks@gmail.com', 'city' => 'Chennai', 'state_wise_distribution' => 'Tamil Nadu'],
            ['company' => 'Vijaya Book House', 'contact_person' => 'Mr Sridhar', 'contact_information' => '044-24640007', 'email_id' => 'N/A', 'city' => 'Chennai', 'state_wise_distribution' => 'Tamil Nadu'],
            ['company' => 'PCM Books', 'contact_person' => 'PCM', 'contact_information' => '9444050325', 'email_id' => 'PCMBOOKS@GMAIL.COM', 'city' => 'Chennai', 'state_wise_distribution' => 'Tamil Nadu'],
            ['company' => 'H&C Books', 'contact_person' => 'H&C', 'contact_information' => '4872421467', 'email_id' => 'handcbooks@gmail.com', 'city' => 'Trichur', 'state_wise_distribution' => 'Kerala'],
            ['company' => 'Print Publications Pvt Ltd', 'contact_person' => 'Mr Neeru Bhalla', 'contact_information' => '+91 98997 44880', 'email_id' => 'info@printspublications.com', 'city' => 'Daryaganj', 'state_wise_distribution' => 'Delhi'],
            ['company' => 'Sangam book agency', 'contact_person' => 'Mr Ravindran badoni', 'contact_information' => '9412381695', 'email_id' => 'sangambookagency@gmail.com', 'city' => 'Dehradun', 'state_wise_distribution' => 'Uttrakhand'],
            ['company' => 'New Lakshmi book depot', 'contact_person' => 'Mr Shalilendra Chandra', 'contact_information' => '+91 9411313498', 'email_id' => 'nibd.schbooks@gmail.com', 'city' => 'Dehradun', 'state_wise_distribution' => 'Uttrakhand'],
        ];

        foreach ($distributors as $distributor) {
            Distributor::create($distributor);
        }
    }
}
