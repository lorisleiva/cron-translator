<?php /** @noinspection PhpRedundantOptionalArgumentInspection */

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorVITest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations trong mỗi/Once.
        $this->assertCronTranslateTo('Mỗi phút', '* * * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật', '* * * * 0', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Tháng Một', '* * * 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật vào Tháng Một', '* * * 1 0', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào ngày 1 hàng tháng', '* * 1 * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật vào ngày 1 hàng tháng', '* * 1 * 0', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Tháng Một ngày 1', '* * 1 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật vào Tháng Một ngày 1', '* * 1 1 0', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào lúc 12am', '* 0 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật vào lúc 12am', '* 0 * * 0', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Tháng Một vào lúc 12am', '* 0 * 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật vào Tháng Một vào lúc 12am', '* 0 * 1 0', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào ngày 1 hàng tháng vào lúc 12am', '* 0 1 * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật vào ngày 1 hàng tháng vào lúc 12am', '* 0 1 * 0', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Tháng Một ngày 1 vào lúc 12am', '* 0 1 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Chủ Nhật vào Tháng Một ngày 1 vào lúc 12am', '* 0 1 1 0', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần', '0 * * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần vào Chủ Nhật', '0 * * * 0', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần vào Tháng Một', '0 * * 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần vào Chủ Nhật vào Tháng Một', '0 * * 1 0', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần vào ngày 1 hàng tháng', '0 * 1 * *', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần vào Chủ Nhật vào ngày 1 hàng tháng', '0 * 1 * 0', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần vào Tháng Một ngày 1', '0 * 1 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần vào Chủ Nhật vào Tháng Một ngày 1', '0 * 1 1 0', 'vi');
        $this->assertCronTranslateTo('Hằng ngày vào lúc 12:00am', '0 0 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi Chủ Nhật vào lúc 12:00am', '0 0 * * 0', 'vi');
        $this->assertCronTranslateTo('Hằng ngày vào Tháng Một vào lúc 12:00am', '0 0 * 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi Chủ Nhật vào Tháng Một vào lúc 12:00am', '0 0 * 1 0', 'vi');
        $this->assertCronTranslateTo('Ngày 1 hàng tháng vào lúc 12:00am', '0 0 1 * *', 'vi');
        $this->assertCronTranslateTo('Ngày 1 hàng tháng vào Chủ Nhật vào lúc 12:00am', '0 0 1 * 0', 'vi');
        $this->assertCronTranslateTo('Hằng năm vào Tháng Một ngày 1 vào lúc 12:00am', '0 0 1 1 *', 'vi');
        $this->assertCronTranslateTo('Vào Chủ Nhật vào Tháng Một ngày 1 vào lúc 12:00am', '0 0 1 1 0', 'vi');

        // More realistic examples.
        $this->assertCronTranslateTo('Hằng năm vào Tháng Một ngày 1 vào lúc 12:00pm', '0 12 1 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Thứ Hai vào lúc 3pm', '* 15 * * 1', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Tháng Một ngày 3', '* * 3 1 *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Thứ Hai vào Tháng Tư', '* * * 4 1', 'vi');
        $this->assertCronTranslateTo('Vào Thứ Hai vào Tháng Tư ngày 22 vào lúc 3:10pm', '10 15 22 4 1', 'vi');

        // Paparazzi examples.
        $this->assertCronTranslateTo('Hằng ngày vào lúc 10:00pm', '0 22 * * *', 'vi');
        $this->assertCronTranslateTo('Hằng ngày vào lúc 9:00am', '0 9 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi Thứ Hai vào lúc 4:00pm', '0 16 * * 1', 'vi');
        $this->assertCronTranslateTo('Hằng năm vào Tháng Một ngày 1 vào lúc 12:00am', '0 0 1 1 *', 'vi');
        $this->assertCronTranslateTo('Ngày 1 hàng tháng vào lúc 12:00am', '0 0 1 * *', 'vi');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateTo('Mỗi phút 2 giờ một ngày', '* 8,18 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút 3 giờ một ngày', '* 8,18,20 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút 20 giờ một ngày', '* 1-20 * * *', 'vi');
        $this->assertCronTranslateTo('2 lần một giờ', '0,30 * * * *', 'vi');
        $this->assertCronTranslateTo('2 lần một giờ 5 giờ một ngày', '0,30 1-5 * * *', 'vi');
        $this->assertCronTranslateTo('5 lần một ngày', '0 1-5 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút 5 giờ một ngày', '* 1-5 * * *', 'vi');
        $this->assertCronTranslateTo('5 ngày một tháng vào lúc 1:00am', '0 1 1-5 * *', 'vi');
        $this->assertCronTranslateTo('5 ngày một tháng 2 tháng một năm vào lúc 1:00am', '0 1 1-5 5,6 *', 'vi');
        $this->assertCronTranslateTo('2 tháng một năm vào ngày 5 vào lúc 1:00am', '0 1 5 5,6 *', 'vi');
        $this->assertCronTranslateTo('Ngày 5 hàng tháng 4 ngày một tuần vào lúc 1:00am', '0 1 5 * 1-4', 'vi');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateTo('Mỗi 2 phút', '*/2 * * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi 2 phút', '1/2 * * * *', 'vi');
        $this->assertCronTranslateTo('2 lần mỗi 4 phút', '1,3/4 * * * *', 'vi');
        $this->assertCronTranslateTo('3 lần mỗi 5 phút', '1-3/5 * * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi 2 phút vào lúc 2pm', '*/2 14 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi giờ một lần mỗi 2 ngày', '0 * */2 * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút mỗi 2 ngày', '* * */2 * *', 'vi');
        $this->assertCronTranslateTo('1 lần mỗi 2 giờ', '0 */2 * * *', 'vi');
        $this->assertCronTranslateTo('2 lần mỗi 5 giờ', '0 1,2/5 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút 2 giờ trong số 5', '* 1,2/5 * * *', 'vi');
        $this->assertCronTranslateTo('Hằng ngày mỗi 4 tháng vào lúc 12:00am', '0 0 * */4 *', 'vi');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateTo('Mỗi phút vào mỗi 2 giờ', '* */2 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào mỗi 3 giờ vào ngày 2 hàng tháng', '* 1/3 2 * *', 'vi');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateTo('Mỗi phút vào lúc 8am', '* 8-8 * * *', 'vi');
        $this->assertCronTranslateTo('Mỗi phút vào Tháng Một', '* * * 1-1 *', 'vi');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateTo('Mỗi giờ một lần', '@hourly', 'vi');
        $this->assertCronTranslateTo('Hằng ngày vào lúc 12:00am', '@daily', 'vi');
        $this->assertCronTranslateTo('Mỗi Chủ Nhật vào lúc 12:00am', '@weekly', 'vi');
        $this->assertCronTranslateTo('Ngày 1 hàng tháng vào lúc 12:00am', '@monthly', 'vi');
        $this->assertCronTranslateTo('Hằng năm vào Tháng Một ngày 1 vào lúc 12:00am', '@yearly', 'vi');
        $this->assertCronTranslateTo('Hằng năm vào Tháng Một ngày 1 vào lúc 12:00am', '@annually', 'vi');
    }

    /**
     * @skip
     * @doesNotPerformAssertions
     */
    public function result_generator(): void
    {
        $this->generateCombinationsFromMatrix([
            ['*', '0', '1,2', '*/2'],
            ['*', '0', '1,2', '*/2'],
            ['*', '1', '1,2', '*/2'],
            ['*', '1', '1,2', '*/2'],
            ['*', '0', '1,2', '*/2'],
        ]);
    }
}
