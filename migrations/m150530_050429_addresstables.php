<?php

/**
 * The migration script for the addresses
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

use yii\db\Schema;

class m150530_050429_addresstables extends \yii\db\Migration
{
	public function up()
	{
    
    switch (Yii::$app->db->driverName) {
        case 'mysql':
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
          break;
        case 'pgsql':
          $tableOptions = null;
          break;
        case 'mssql':
          $tableOptions = null;
          break;
        default:
          throw new RuntimeException('Your database is not supported!');
    }

		$this->createTable('{{%net_frenzel_address}}',[
      'id'                => Schema::TYPE_PK,
      'cityName'          => Schema::TYPE_STRING .'(100)',
      'zipCode'           => Schema::TYPE_STRING .'(20)',
      'postBox'           => Schema::TYPE_STRING .'(20)',
      'addresslineOne'    => Schema::TYPE_STRING .'(100)',
      'addresslineTwo'    => Schema::TYPE_STRING .'(100)',
      'regionName'        => Schema::TYPE_STRING .'(50)',
      
      //related to which record
      'entity'            => Schema::TYPE_STRING,
      'entity_id'         => Schema::TYPE_INTEGER . ' NOT NULL',

      //blamable
      'created_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
      
      // timestamps
      'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL',

      //Foreign Keys
      'country_id'        => Schema::TYPE_INTEGER,      
    ],$tableOptions);

    $this->addColumn('{{%net_frenzel_address}}','latitude',Schema::TYPE_FLOAT .' DEFAULT 0.00');
    $this->addColumn('{{%net_frenzel_address}}','longitude',Schema::TYPE_FLOAT .' DEFAULT 0.00');

    $this->createTable('{{%net_frenzel_country}}',[
      'id'                => Schema::TYPE_PK,
      
      'iso2'              => Schema::TYPE_STRING .'(2)',
      'iso3'              => Schema::TYPE_STRING .'(3)',
      'name'              => Schema::TYPE_STRING .'(100)',
      
      //blamable
      'created_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
      
      // timestamps
      'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL'

    ],$tableOptions);

    $this->insert('{{%net_frenzel_country}}',['iso2' => 'US', 'name' => 'United States']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CA', 'name' => 'Canada']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AF', 'name' => 'Afghanistan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AL', 'name' => 'Albania']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'DZ', 'name' => 'Algeria']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'DS', 'name' => 'American Samoa']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AD', 'name' => 'Andorra']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AO', 'name' => 'Angola']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AI', 'name' => 'Anguilla']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AQ', 'name' => 'Antarctica']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AG', 'name' => 'Antigua and/or Barbuda']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AR', 'name' => 'Argentina']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AM', 'name' => 'Armenia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AW', 'name' => 'Aruba']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AU', 'name' => 'Australia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AT', 'name' => 'Austria']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AZ', 'name' => 'Azerbaijan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BS', 'name' => 'Bahamas']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BH', 'name' => 'Bahrain']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BD', 'name' => 'Bangladesh']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BB', 'name' => 'Barbados']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BY', 'name' => 'Belarus']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BE', 'name' => 'Belgium']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BZ', 'name' => 'Belize']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BJ', 'name' => 'Benin']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BM', 'name' => 'Bermuda']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BT', 'name' => 'Bhutan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BO', 'name' => 'Bolivia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BA', 'name' => 'Bosnia and Herzegovina']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BW', 'name' => 'Botswana']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BV', 'name' => 'Bouvet Island']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BR', 'name' => 'Brazil']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IO', 'name' => 'British lndian Ocean Territory']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BN', 'name' => 'Brunei Darussalam']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BG', 'name' => 'Bulgaria']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BF', 'name' => 'Burkina Faso']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'BI', 'name' => 'Burundi']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KH', 'name' => 'Cambodia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CM', 'name' => 'Cameroon']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CV', 'name' => 'Cape Verde']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KY', 'name' => 'Cayman Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CF', 'name' => 'Central African Republic']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TD', 'name' => 'Chad']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CL', 'name' => 'Chile']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CN', 'name' => 'China']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CX', 'name' => 'Christmas Island']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CC', 'name' => 'Cocos (Keeling) Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CO', 'name' => 'Colombia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KM', 'name' => 'Comoros']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CG', 'name' => 'Congo']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CK', 'name' => 'Cook Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CR', 'name' => 'Costa Rica']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'HR', 'name' => 'Croatia (Hrvatska)']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CU', 'name' => 'Cuba']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CY', 'name' => 'Cyprus']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CZ', 'name' => 'Czech Republic']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'DK', 'name' => 'Denmark']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'DJ', 'name' => 'Djibouti']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'DM', 'name' => 'Dominica']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'DO', 'name' => 'Dominican Republic']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TP', 'name' => 'East Timor']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'EC', 'name' => 'Ecuador']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'EG', 'name' => 'Egypt']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SV', 'name' => 'El Salvador']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GQ', 'name' => 'Equatorial Guinea']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ER', 'name' => 'Eritrea']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'EE', 'name' => 'Estonia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ET', 'name' => 'Ethiopia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'FK', 'name' => 'Falkland Islands (Malvinas)']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'FO', 'name' => 'Faroe Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'FJ', 'name' => 'Fiji']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'FI', 'name' => 'Finland']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'FR', 'name' => 'France']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'FX', 'name' => 'France, Metropolitan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GF', 'name' => 'French Guiana']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PF', 'name' => 'French Polynesia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TF', 'name' => 'French Southern Territories']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GA', 'name' => 'Gabon']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GM', 'name' => 'Gambia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GE', 'name' => 'Georgia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'DE', 'name' => 'Germany']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GH', 'name' => 'Ghana']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GI', 'name' => 'Gibraltar']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GR', 'name' => 'Greece']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GL', 'name' => 'Greenland']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GD', 'name' => 'Grenada']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GP', 'name' => 'Guadeloupe']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GU', 'name' => 'Guam']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GT', 'name' => 'Guatemala']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GN', 'name' => 'Guinea']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GW', 'name' => 'Guinea-Bissau']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GY', 'name' => 'Guyana']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'HT', 'name' => 'Haiti']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'HM', 'name' => 'Heard and Mc Donald Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'HN', 'name' => 'Honduras']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'HK', 'name' => 'Hong Kong']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'HU', 'name' => 'Hungary']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IS', 'name' => 'Iceland']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IN', 'name' => 'India']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ID', 'name' => 'Indonesia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IR', 'name' => 'Iran (Islamic Republic of)']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IQ', 'name' => 'Iraq']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IE', 'name' => 'Ireland']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IL', 'name' => 'Israel']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'IT', 'name' => 'Italy']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CI', 'name' => 'Ivory Coast']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'JM', 'name' => 'Jamaica']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'JP', 'name' => 'Japan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'JO', 'name' => 'Jordan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KZ', 'name' => 'Kazakhstan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KE', 'name' => 'Kenya']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KI', 'name' => 'Kiribati']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KP', 'name' => 'Korea, Democratic People''s Republic of']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KR', 'name' => 'Korea, Republic of']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'XK', 'name' => 'Kosovo']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KW', 'name' => 'Kuwait']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KG', 'name' => 'Kyrgyzstan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LA', 'name' => 'Lao People''s Democratic Republic']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LV', 'name' => 'Latvia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LB', 'name' => 'Lebanon']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LS', 'name' => 'Lesotho']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LR', 'name' => 'Liberia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LY', 'name' => 'Libyan Arab Jamahiriya']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LI', 'name' => 'Liechtenstein']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LT', 'name' => 'Lithuania']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LU', 'name' => 'Luxembourg']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MO', 'name' => 'Macau']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MK', 'name' => 'Macedonia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MG', 'name' => 'Madagascar']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MW', 'name' => 'Malawi']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MY', 'name' => 'Malaysia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MV', 'name' => 'Maldives']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ML', 'name' => 'Mali']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MT', 'name' => 'Malta']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MH', 'name' => 'Marshall Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MQ', 'name' => 'Martinique']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MR', 'name' => 'Mauritania']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MU', 'name' => 'Mauritius']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TY', 'name' => 'Mayotte']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MX', 'name' => 'Mexico']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'FM', 'name' => 'Micronesia, Federated States of']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MD', 'name' => 'Moldova, Republic of']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MC', 'name' => 'Monaco']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MN', 'name' => 'Mongolia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ME', 'name' => 'Montenegro']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MS', 'name' => 'Montserrat']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MA', 'name' => 'Morocco']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MZ', 'name' => 'Mozambique']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MM', 'name' => 'Myanmar']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NA', 'name' => 'Namibia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NR', 'name' => 'Nauru']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NP', 'name' => 'Nepal']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NL', 'name' => 'Netherlands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AN', 'name' => 'Netherlands Antilles']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NC', 'name' => 'New Caledonia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NZ', 'name' => 'New Zealand']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NI', 'name' => 'Nicaragua']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NE', 'name' => 'Niger']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NG', 'name' => 'Nigeria']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NU', 'name' => 'Niue']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NF', 'name' => 'Norfork Island']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'MP', 'name' => 'Northern Mariana Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'NO', 'name' => 'Norway']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'OM', 'name' => 'Oman']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PK', 'name' => 'Pakistan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PW', 'name' => 'Palau']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PA', 'name' => 'Panama']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PG', 'name' => 'Papua New Guinea']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PY', 'name' => 'Paraguay']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PE', 'name' => 'Peru']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PH', 'name' => 'Philippines']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PN', 'name' => 'Pitcairn']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PL', 'name' => 'Poland']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PT', 'name' => 'Portugal']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PR', 'name' => 'Puerto Rico']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'QA', 'name' => 'Qatar']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'RE', 'name' => 'Reunion']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'RO', 'name' => 'Romania']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'RU', 'name' => 'Russian Federation']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'RW', 'name' => 'Rwanda']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'KN', 'name' => 'Saint Kitts and Nevis']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LC', 'name' => 'Saint Lucia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'VC', 'name' => 'Saint Vincent and the Grenadines']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'WS', 'name' => 'Samoa']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SM', 'name' => 'San Marino']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ST', 'name' => 'Sao Tome and Principe']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SA', 'name' => 'Saudi Arabia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SN', 'name' => 'Senegal']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'RS', 'name' => 'Serbia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SC', 'name' => 'Seychelles']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SL', 'name' => 'Sierra Leone']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SG', 'name' => 'Singapore']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SK', 'name' => 'Slovakia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SI', 'name' => 'Slovenia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SB', 'name' => 'Solomon Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SO', 'name' => 'Somalia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ZA', 'name' => 'South Africa']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GS', 'name' => 'South Georgia South Sandwich Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ES', 'name' => 'Spain']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'LK', 'name' => 'Sri Lanka']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SH', 'name' => 'St. Helena']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'PM', 'name' => 'St. Pierre and Miquelon']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SD', 'name' => 'Sudan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SR', 'name' => 'Suriname']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SJ', 'name' => 'Svalbarn and Jan Mayen Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SZ', 'name' => 'Swaziland']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SE', 'name' => 'Sweden']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'CH', 'name' => 'Switzerland']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'SY', 'name' => 'Syrian Arab Republic']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TW', 'name' => 'Taiwan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TJ', 'name' => 'Tajikistan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TZ', 'name' => 'Tanzania, United Republic of']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TH', 'name' => 'Thailand']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TG', 'name' => 'Togo']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TK', 'name' => 'Tokelau']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TO', 'name' => 'Tonga']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TT', 'name' => 'Trinidad and Tobago']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TN', 'name' => 'Tunisia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TR', 'name' => 'Turkey']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TM', 'name' => 'Turkmenistan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TC', 'name' => 'Turks and Caicos Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'TV', 'name' => 'Tuvalu']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'UG', 'name' => 'Uganda']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'UA', 'name' => 'Ukraine']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'AE', 'name' => 'United Arab Emirates']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'GB', 'name' => 'United Kingdom']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'UM', 'name' => 'United States minor outlying islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'UY', 'name' => 'Uruguay']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'UZ', 'name' => 'Uzbekistan']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'VU', 'name' => 'Vanuatu']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'VA', 'name' => 'Vatican City State']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'VE', 'name' => 'Venezuela']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'VN', 'name' => 'Vietnam']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'VG', 'name' => 'Virgin Islands (British)']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'VI', 'name' => 'Virgin Islands (U.S.)']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'WF', 'name' => 'Wallis and Futuna Islands']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'EH', 'name' => 'Western Sahara']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'YE', 'name' => 'Yemen']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'YU', 'name' => 'Yugoslavia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ZR', 'name' => 'Zaire']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ZM', 'name' => 'Zambia']);
    $this->insert('{{%net_frenzel_country}}',['iso2' => 'ZW', 'name' => 'Zimbabwe']);

    $this->addForeignKey('fk_address_country', '{{%net_frenzel_address}}', 'country_id', '{{%net_frenzel_country}}', 'id', 'CASCADE', 'RESTRICT');

	}

	public function down()
	{
		//drop FK's first
    $this->dropForeignKey('fk_address_country', '{{%net_frenzel_address}}');

		$this->dropTable('{{%net_frenzel_address}}');
    $this->dropTable('{{%net_frenzel_country}}');
	}
}
