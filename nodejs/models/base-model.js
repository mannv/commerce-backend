class BaseModel {
  model = null

  constructor (model) {
    this.model = model
  }

  async getById (id) {
    return await this.model.findById(id).select('-__v')
  }

  async getAll (sort = { _id: -1 }) {
    return await this.model.find({}).select('-__v').sort(sort)
  }
}

module.exports = BaseModel