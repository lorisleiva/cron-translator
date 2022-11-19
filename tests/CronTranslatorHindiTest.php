<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorHindiTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_to_hindi_with_alle_and_once(): void
    {
        $this->assertCronTranslateToHi('प्रत्येक क्षण', '* * * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को', '* * * * 0');
        $this->assertCronTranslateToHi('प्रत्येक क्षण जनवरी महीने में', '* * * 1 *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को जनवरी महीने में', '* * * 1 0');
        $this->assertCronTranslateToHi('प्रत्येक क्षण प्रत्येक महीने की पहली तारीख को', '* * 1 * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को प्रत्येक महीने की पहली तारीख को', '* * 1 * 0');
        $this->assertCronTranslateToHi('प्रत्येक क्षण पहली जनवरी को', '* * 1 1 *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को पहली जनवरी को', '* * 1 1 0');
        $this->assertCronTranslateToHi('प्रत्येक क्षण 0:00 पर', '* 0 * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को 0:00 पर', '* 0 * * 0');
        $this->assertCronTranslateToHi('प्रत्येक क्षण जनवरी महीने में 0:00 पर', '* 0 * 1 *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को जनवरी महीने में 0:00 पर', '* 0 * 1 0');
        $this->assertCronTranslateToHi('प्रत्येक क्षण प्रत्येक महीने की पहली तारीख को 0:00 पर', '* 0 1 * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को प्रत्येक महीने की पहली तारीख को 0:00 पर', '* 0 1 * 0');
        $this->assertCronTranslateToHi('प्रत्येक क्षण पहली जनवरी को 0:00 पर', '* 0 1 1 *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण रविवार को पहली जनवरी को 0:00 पर', '* 0 1 1 0');
        $this->assertCronTranslateToHi('घंटे में एक बार', '0 * * * *');
        $this->assertCronTranslateToHi('घंटे में एक बार रविवार को', '0 * * * 0');
        $this->assertCronTranslateToHi('घंटे में एक बार जनवरी महीने में', '0 * * 1 *');
        $this->assertCronTranslateToHi('घंटे में एक बार रविवार को जनवरी महीने में', '0 * * 1 0');
        $this->assertCronTranslateToHi('घंटे में एक बार प्रत्येक महीने की पहली तारीख को', '0 * 1 * *');
        $this->assertCronTranslateToHi("घंटे में एक बार रविवार को प्रत्येक महीने की पहली तारीख को","0 * 1 * 0");
        $this->assertCronTranslateToHi("घंटे में एक बार पहली जनवरी को","0 * 1 1 *");
        $this->assertCronTranslateToHi("घंटे में एक बार रविवार को पहली जनवरी को","0 * 1 1 0");
        $this->assertCronTranslateToHi('प्रत्येक दिन 0:00 पर','0 0 * * *');
        $this->assertCronTranslateToHi('प्रत्येक रविवार 0:00 पर','0 0 * * 0');
        $this->assertCronTranslateToHi('प्रत्येक दिन जनवरी महीने में 0:00 पर','0 0 * 1 *');
        $this->assertCronTranslateToHi('प्रत्येक रविवार जनवरी महीने में 0:00 पर','0 0 * 1 0');
        $this->assertCronTranslateToHi('प्रत्येक महीने की पहली 0:00 पर','0 0 1 * *');
        $this->assertCronTranslateToHi('प्रत्येक महीने की पहली रविवार को 0:00 पर','0 0 1 * 0');
        $this->assertCronTranslateToHi('प्रत्येक वर्ष पहली जनवरी को 0:00 पर','0 0 1 1 *');
        $this->assertCronTranslateToHi('रविवार को पहली जनवरी को 0:00 पर','0 0 1 1 0');
        $this->assertCronTranslateToHi('प्रत्येक वर्ष पहली जनवरी को 12:00 पर','0 12 1 1 *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण सोमवार को 15:00 पर','* 15 * * 1');
        $this->assertCronTranslateToHi('प्रत्येक क्षण पहली जनवरी को','* * 3 1 *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण सोमवार को अप्रैल महीने में','* * * 4 1');
        $this->assertCronTranslateToHi('सोमवार को पहली अप्रैल को 15:10 पर','10 15 22 4 1');
        $this->assertCronTranslateToHi('प्रत्येक दिन 22:00 पर','0 22 * * *');
        $this->assertCronTranslateToHi('प्रत्येक दिन 9:00 पर','0 9 * * *');
        $this->assertCronTranslateToHi('प्रत्येक सोमवार 16:00 पर','0 16 * * 1');
        $this->assertCronTranslateToHi('प्रत्येक वर्ष पहली जनवरी को 0:00 पर','0 0 1 1 *');
        $this->assertCronTranslateToHi('प्रत्येक महीने की पहली 0:00 पर','0 0 1 * *');
    }

     /** @test */
    public function it_translate_expressions_to_hindi_with_multiple(): void
    {
        $this->assertCronTranslateToHi('प्रत्येक क्षण दिन में 2 घंटे','* 8,18 * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण दिन में 3 घंटे','* 8,18,20 * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण दिन में 20 घंटे','* 1-20 * * *');
        $this->assertCronTranslateToHi('घंटे में दो बार','0,30 * * * *');
        $this->assertCronTranslateToHi('घंटे में दो बार दिन में 5 घंटे','0,30 1-5 * * *');
        $this->assertCronTranslateToHi('दिन में 5 बार','0 1-5 * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण दिन में 5 घंटे','* 1-5 * * *');
        $this->assertCronTranslateToHi('महीने में 5 दिन 1:00 पर','0 1 1-5 * *');
        $this->assertCronTranslateToHi('महीने में 5 दिन साल में 2 महीने 1:00 पर','0 1 1-5 5,6 *');
        $this->assertCronTranslateToHi("साल में 2 महीने 5th को 1:00 पर","0 1 5 5,6 *");
        $this->assertCronTranslateToHi('प्रत्येक महीने की 5th सप्ताह में 4 दिन 1:00 पर','0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_to_hindi_with_increment(): void
    {
        $this->assertCronTranslateToHi('प्रत्येक 2 क्षण','*/2 * * * *');
        $this->assertCronTranslateToHi('प्रत्येक 2 क्षण','1/2 * * * *');
        $this->assertCronTranslateToHi('दो बार प्रत्येक 4 क्षण','1,3/4 * * * *');
        $this->assertCronTranslateToHi('3 बार प्रत्येक 5 क्षण','1-3/5 * * * *');
        $this->assertCronTranslateToHi('प्रत्येक 2 क्षण 14:00 पर','*/2 14 * * *');
        $this->assertCronTranslateToHi('घंटे में एक बार प्रत्येक 2 दिन','0 * */2 * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण प्रत्येक 2 दिन','* * */2 * *');
        $this->assertCronTranslateToHi('एक बार प्रत्येक 2 घंटे','0 */2 * * *');
        $this->assertCronTranslateToHi('दो बार प्रत्येक 5 घंटे','0 1,2/5 * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण 5 में से 2 घंटे ','* 1,2/5 * * *');
        $this->assertCronTranslateToHi('प्रत्येक दिन प्रत्येक 4 महीने 0:00 पर','0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types_in_hindi(): void
    {
        $this->assertCronTranslateToHi('प्रत्येक क्षण प्रत्येक 2 घंटे में','* */2 * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण प्रत्येक 3 घंटे में प्रत्येक महीने की दूसरी तारीख को','* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types_in_hindi(): void
    {
        $this->assertCronTranslateToHi('प्रत्येक क्षण 8:00 पर','* 8-8 * * *');
        $this->assertCronTranslateToHi('प्रत्येक क्षण जनवरी महीने में','* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax_in_hindi(): void
    {
        $this->assertCronTranslateToHi("घंटे में एक बार","@hourly");
        $this->assertCronTranslateToHi("प्रत्येक दिन 0:00 पर","@daily");
        $this->assertCronTranslateToHi("प्रत्येक रविवार 0:00 पर","@weekly");
        $this->assertCronTranslateToHi("प्रत्येक महीने की पहली 0:00 पर","@monthly");
        $this->assertCronTranslateToHi("प्रत्येक वर्ष पहली जनवरी को 0:00 पर","@yearly");
        $this->assertCronTranslateToHi("प्रत्येक वर्ष पहली जनवरी को 0:00 पर","@annually");
    }

   

    public function assertCronTranslateToHi(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'hi', $timeFormat24hours);
    }
}
