// src/api/query-runner/controllers/query-runner.js

module.exports = {
  async runQuery(ctx) {
    try {
      const { query, parameters } = ctx.request.body;

      // SELECTクエリで特定のテーブルのみを許可
      if (!this.isSelectQueryAllowed(query)) {
        ctx.throw(400, 'Only SELECT queries are allowed on specific tables');
      }

      // SQLインジェクション対策：パラメータ化されたクエリを使用
      const result = await strapi.db.connection.raw(query, parameters);

      // 結果の返送
      ctx.body = result;
    } catch (err) {
      ctx.throw(500, `Error executing query: ${err.message}`);
    }
  },

  // SELECTクエリで特定のテーブルのみを許可する関数
  isSelectQueryAllowed(query) {
    const queryLowerCase = query.toLowerCase();
    const allowedTables = [
      'user_info', 'user_infos', 'department', 'departments', 
      'post', 'posts', 'user_basic', 'user_basics','test'
    ];

    // SELECTクエリを確認
    if (!queryLowerCase.startsWith('select')) {
      return false;
    }

    // 許可されたテーブルを含むか確認
    return allowedTables.some(table => 
      queryLowerCase.includes(`from ${table}`) || queryLowerCase.includes(`join ${table}`)
    );
  }
};
