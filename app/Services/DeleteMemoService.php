<?php
namespace App\Services;
use App\Exceptions\NotFoundException;
use App\Models\knowledgeMemo;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use SebastianBergmann\Environment\Runtime;

class DeleteMemoService
{
    private ?string $delete_message = null;

    public function getDeleteMessage(): ?string
    {
        return $this->delete_message;
    }

    /**
     * Undocumented function
     *
     * @param integer $memoId
     * @return boolean
     */
    public function deleteMemo(int $memoId): bool
    {
        DB::beginTransaction();
        try
        {
            $memo = knowledgeMemo::lockForUpdate()->find($memoId);

            // 削除対象ユーザが存在しない又は削除済みの場合エラー
            if ($memo === null)
            {
                throw new RuntimeException();
            }

            // 削除処理実行
            $memo->delete();

            DB::commit();

            //$this->delete_message = '選択したメモを削除しました。';

            return true;
        }
        catch (RuntimeException $e)
        { //エラーメッセージの出し分けは後でやる(大変そうなので)
            DB::rollBack();
            \Log::error($e->getMessage());

            $this->delete_message = 'メモが存在しないかすでに削除されています。';

            return false;
        }
        catch (Exception $e)
        {
            DB::rollBack();
            \Log::error($e->getMessage());

            $this->delete_message = '予期せぬエラーが発生しました。';

            return false;
        }
    }
}