class DataWrapper {
  success (res, data) {
    return res.status(200).send({ data: data, status: 200 });
  }

  error (res, message, status = 404) {
    return res.status(status).send({ data: null, message, status });
  }
}

module.exports = new DataWrapper()